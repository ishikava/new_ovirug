<?php

namespace App;

use DOMDocument;
use DOMElement;


class ParseXMLResponse
{
    /**
     * @param $xmlString
     * @return array
     */
    public function parseAckRequestResponse($xmlString)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadXML($xmlString);

        if ($soapFault = $this->checkIsSoapFault($dom)) {
            return [
                'success' => false,
                'message' => $soapFault
            ];
        }

        return [
            'success' => true
        ];
    }

    /**
     * @param $xmlString
     * @return array
     */
    public function parseSendRequestRequestResponse($xmlString)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadXML($xmlString);

        if ($soapFault = $this->checkIsSoapFault($dom)) {
            return [
                'success' => false,
                'message' => $soapFault
            ];
        }

        // get message id
        $messageId = null;
        $messageIdNodes = $dom->getElementsByTagName('MessageId');
        if ($messageIdNodes->length) {
            $messageId = $messageIdNodes->item(0)->textContent;
        }

        if ($messageId) {
            return [
                'success' => true,
                'messageId' => $messageId
            ];
        }

        return [
            'success' => false,
            'message' => 'unknown error'
        ];
    }

    /**
     * @param $xmlString
     * @param $service
     * @return array
     */
    public function parseGetRequestResponseResponse($xmlString, $service)
    {
        $xmlString1 = '<?xml version=\'1.0\' encoding=\'utf-8\'?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"><SOAP-ENV:Header/><SOAP-ENV:Body><ns4:GetResponseResponse xmlns:ns4="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/1.1" xmlns:ns2="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/basic/1.1" xmlns:ns3="urn://x-artefacts-smev-gov-ru/services/message-exchange/types/faults/1.1"/></SOAP-ENV:Body></SOAP-ENV:Envelope>';
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->loadXML($xmlString);

        if ($soapFault = $this->checkIsSoapFault($dom)) {
            return [
                'success' => false,
                'message' => $soapFault
            ];
        }

        if ($clearQueue = $this->checkIsQueueIsClear($dom)) {
            return [
                'success' => false,
                'message' => 'Очередь ответов пуста'
            ];
        }

        // get original message id (for response)
        $originalMessageId = null;
        $originalMessageIdNodes = $dom->getElementsByTagName('OriginalMessageId');
        if ($originalMessageIdNodes->length) {
            $originalMessageId = $originalMessageIdNodes->item(0)->textContent;
        }

        // get message id (for ack request)
        $messageId = null;
        $messageIdNodes = $dom->getElementsByTagName('MessageId');
        if ($messageIdNodes->length) {
            $messageId = $messageIdNodes->item(0)->textContent;
        }

        if ($smevFault = $this->checkIsSmevFault($dom)) {
            return [
                'success' => false,
                'originalMessageId' => $originalMessageId,
                'messageId' => $messageId,
                'message' => $smevFault
            ];
        }

        $data = null;
        if ($service === 'inn') {
            $data = $this->getInn($dom);

        } elseif ($service === 'snils') {
            $data = $this->getSnils($dom);
        }

        return [
            'success' => true,
            'originalMessageId' => $originalMessageId,
            'messageId' => $messageId,
            'data' => $data
        ];
    }

    /**
     * @param DOMDocument $dom
     * @return bool
     */
    private function checkIsQueueIsClear(DOMDocument $dom)
    {
        $getResponseResponseList = $dom->getElementsByTagName('GetResponseResponse');
        if ($getResponseResponseList->length) {
            $getResponseResponse = $getResponseResponseList->item(0);
            return !$getResponseResponse->hasChildNodes();
        }

        return false;
    }

    /**
     * @param DOMDocument $dom
     * @return array|null
     */
    private function getSnils(DOMDocument $dom)
    {
        $snilsResponse = $dom->getElementsByTagName('SnilsByDataResponse');
        if ($snilsResponse->length) {
            return $this->getXmlArrayData($snilsResponse->item(0));
        }

        return null;
    }

    /**
     * @param DOMDocument $dom
     * @return array
     */
    private function getInn(DOMDocument $dom)
    {
        $inn = null;
        $innResponse = $dom->getElementsByTagName('FNSINNSingularResponse');
        if ($innResponse->length) {
            $innResponse = $innResponse->item(0);
            $inn = [
                'inn' => $innResponse->getAttribute('ИННФЛ')
            ];
        }
        return $inn;
    }

    /**
     * @param DOMDocument $dom
     * @return bool|null|string
     */
    private function checkIsSoapFault(DOMDocument $dom)
    {
        $faultsNodes = $dom->getElementsByTagNameNS(
            'http://schemas.xmlsoap.org/soap/envelope/',
            'Fault'
        );

        if ($faultsNodes->length) {
            $fault = $faultsNodes->item(0);
            $faultString = null;
            $faultStrings = $fault->getElementsByTagName('faultstring');
            if ($faultStrings->length) {
                $faultString = $faultStrings->item(0)->textContent;
            }

            return $faultString;
        }

        return false;
    }

    /**
     * @param DOMDocument $dom
     * @return bool|null|string
     */
    private function checkIsSmevFault(DOMDocument $dom)
    {
        $smevFaultList = $dom->getElementsByTagName('SmevFault');
        if ($smevFaultList->length) {
            $smevFault = $smevFaultList->item(0);
            $descriptionList = $smevFault->getElementsByTagName('Description');
            $description = null;
            if ($descriptionList->length) {
                $description = $descriptionList->item(0)->textContent;
            }

            return $description;
        }

        return false;
    }

    /**
     * @param DOMElement $domElement
     * @return array
     */
    private function getXmlArrayData(DOMElement $domElement)
    {
        $result = [];

        $children = $domElement->childNodes;

        $childNames = [];
        foreach ($children as $child) {
            if (isset($childNames[$child->localName])) {
                $childNames[$child->localName]++;
            } else {
                $childNames[$child->localName] = 0;
            }
        }

        foreach ($children as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE) {
                if ($childNames[$child->localName]) {
                    $result[$child->localName][] = $this->getXmlArrayData($child);
                } else {
                    $result[$child->localName] = $this->getXmlArrayData($child);
                }
            } else {
                return $child->textContent;
            }
        }

        return $result;
    }
}