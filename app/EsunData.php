<?php

namespace App;

use DOMDocument;
use stdClass;

class EsunData
{

    public function jsonToXml($jsonArray)
    {
        $xml = new DomDocument('1.0', 'utf-8');

        //$prerequisites = json_decode(utf8_encode($jsonArray), false, 512, JSON_UNESCAPED_UNICODE);
        $prerequisites = json_decode($jsonArray, false, 512, JSON_UNESCAPED_UNICODE);

        $prerequisitesRequest = $xml->createElementNS('urn:eis:cprp:oviru:DataObjects', 'prerequisitesRequest');
        $xml->appendChild($prerequisitesRequest);

        foreach ($prerequisites as $data) {

            $prerequisite = $prerequisitesRequest->appendChild($xml->createElement('prerequisite'));
            $prerequisite->appendChild($xml->createElement('prereqId', $data->prereqId ?? ''));
            $prerequisite->appendChild($xml->createElement('formType', $data->formType ?? ''));
            $prerequisite->appendChild($xml->createElement('regType', $data->regType ?? ''));

            if (isset($data->person)) {
                $prerequisite->appendChild($this->createPerson($xml, $data->person));
            }

            if (isset($data->idPaper)) {
                $prerequisite->appendChild($this->createIdPaper($xml, $data->idPaper));
            }

            if (isset($data->legalRepresentative)) {
                $prerequisite->appendChild($this->createLegalRepresentative($xml, $data->legalRepresentative));
            }

            if (isset($data->renterInfo)) {
                $prerequisite->appendChild($this->createRenterInfo($xml, $data->renterInfo));
            }

            if (isset($data->registrationAddress)) {
                $prerequisite->appendChild($this->createAddress($xml, $data->registrationAddress,
                    'registrationAddress'));
            }

            if (isset($data->fromToAddress)) {
                $prerequisite->appendChild($this->createAddress($xml, $data->fromToAddress, 'fromToAddress'));
            }

            $prerequisite->appendChild($xml->createElement('applicationDate',
                $this->getXsdDate($data->applicationDate)));

            $subdivision = $prerequisite->appendChild($xml->createElement('subdivision'));
            $subdivisionName = $subdivision->appendChild($xml->createElement('name'));
            $subdivisionName->appendChild($xml->createElement('value', $data->subdivision->name->value ?? ''));
            $subdivision->appendChild($xml->createElement('code', $data->subdivision->code ?? ''));
        }

        return $xml;
    }

    public function prepareParams($request_data)
    {
        $params = new stdClass();
        $params->serviceId = '{urn:eis:cprp:oviru:Service}prerequisitesReception';
        $params->serviceConsumerId = 'urn:eis:ovirug';

        $xml = $this->jsonToXml($request_data);

        $requestDocument = new stdClass();
        $requestDocument->any = $xml->saveXML($xml->firstChild);

        $params->requestDocument = $requestDocument;
        $params->serviceProducerId = 'urn:eis:cprp:spc';

        return $params;
    }

    public function getGPRUData($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        $std = json_decode($json);

        if (isset($std->addressSlipRefuse)) {
            return $this->getAddressSlipRefusesData($std->addressSlipRefuse);
        } else {
            return $this->getAddressSlipsData($std->addressSlip);
        }
    }

    private function createPerson(DomDocument $xml, stdClass $data)
    {
        $person = $xml->createElement('person');
        $person->appendChild($xml->createElement('personId', $data->personId ?? ''));
        $person->appendChild($xml->createElement('lastName', $data->lastName ?? ''));
        $person->appendChild($xml->createElement('firstName', $data->firstName ?? ''));
        if (isset($data->middleName)) {
            $person->appendChild($xml->createElement('middleName', $data->middleName ?? ''));
        }
        $person->appendChild($xml->createElement('birthday', $data->birthday ?? ''));
        $person->appendChild($xml->createElement('sex', $data->sex ?? ''));

        $birthPlace = $person->appendChild($xml->createElement('birthPlace'));
        $country = $birthPlace->appendChild($xml->createElement('country'));
        $country->appendChild($xml->createElement('value', $data->birthPlace->country->value ?? ''));

        if (isset($data->birthPlace->region)) {
            $birthPlace->appendChild($xml->createElement('region', $data->birthPlace->region));
        }

        if (isset($data->birthPlace->district)) {
            $birthPlace->appendChild($xml->createElement('district', $data->birthPlace->district));
        }

        if (isset($data->birthPlace->city)) {
            $birthPlace->appendChild($xml->createElement('city', $data->birthPlace->city));
        }

        if (isset($data->person->birthPlace->locality)) {
            $birthPlace->appendChild($xml->createElement('locality', $data->person->birthPlace->locality));
        }

        return $person;
    }

    private function createIdPaper(DomDocument $xml, stdClass $data)
    {
        $paperId = $xml->createElement('idPaper');
        $paperId->appendChild($xml->createElement('documentId', $data->documentId ?? ''));
        $kindPaper = $paperId->appendChild($xml->createElement('kindPaper'));
        $kindPaper->appendChild($xml->createElement('value', $data->kindPaper->value ?? ''));

        if (isset($data->series)) {
            $paperId->appendChild($xml->createElement('series', $data->series));
        }

        $paperId->appendChild($xml->createElement('number', $data->number));
        $paperId->appendChild($xml->createElement('issueDate', $this->getXsdDate($data->issueDate)));

        $issuesRegOrgan = $paperId->appendChild($xml->createElement('issuesRegOrgan'));
        $issuesRegOrganName = $issuesRegOrgan->appendChild($xml->createElement('name'));
        $issuesRegOrganName->appendChild($xml->createElement('value', $data->issuesRegOrgan->name->value ?? ''));
        $issuesRegOrgan->appendChild($xml->createElement('code', $data->issuesRegOrgan->code));

        if (isset($data->sideInformation)) {
            $paperId->appendChild($xml->createElement('sideInformation', $data->sideInformation));
        }

        return $paperId;
    }

    private function createLegalRepresentative(DomDocument $xml, stdClass $data)
    {
        $legalRepresentative = $xml->createElement('legalRepresentative');
        $type = $legalRepresentative->appendChild($xml->createElement('type'));
        $type->appendChild($xml->createElement('value', $data->type->value ?? ''));

        if (isset($data->person)) {
            $legalRepresentative->appendChild($this->createPerson($xml, $data->person));
        }

        if (isset($data->idPaper)) {
            $legalRepresentative->appendChild($this->createIdPaper($xml, $data->idPaper));
        }

        return $legalRepresentative;
    }

    private function createRenterInfo(DomDocument $xml, stdClass $data)
    {
        $renterInfo = $xml->createElement('renterInfo');
        $renterInfo->appendChild($xml->createElement('type', $data->type));

        if (isset($data->person)) {
            $renterInfo->appendChild($this->createPerson($xml, $data->person));
        }

        if (isset($data->idPaper)) {
            $renterInfo->appendChild($this->createIdPaper($xml, $data->idPaper));
        }

        if (isset($data->organization)) {
            $renterInfo->appendChild($xml->createElement('organization', $data->organization));
        }

        return $renterInfo;
    }

    private function createAddress(DomDocument $xml, stdClass $data, $nodeName)
    {
        $addressNode = $xml->createElement($nodeName);

        $country = $addressNode->appendChild($xml->createElement('country'));
        $country->appendChild($xml->createElement('value', $data->country->value));

        if (isset($data->detailedAddress)) {
            $addressNode->appendChild($this->createDetailedAddress($xml, $data->detailedAddress));
        }

        if (isset($data->easPrefix)) {
            $addressNode->appendChild($xml->createElement('easPrefix', $data->easPrefix));
        }

        if (isset($data->easCode)) {
            $addressNode->appendChild($xml->createElement('easCode', $data->easCode));
        }

        if (isset($data->ovirugId)) {
            $addressNode->appendChild($xml->createElement('ovirugId', $data->ovirugId));
        }

        $addressNode->appendChild($xml->createElement('addressString', $data->addressString ?? ''));

        if (isset($data->startingDate)) {
            $addressNode->appendChild($xml->createElement('startingDate', $this->getXsdDate($data->startingDate)));
        }

        if (isset($data->endingDate)) {
            $addressNode->appendChild($xml->createElement('endingDate', $this->getXsdDate($data->endingDate)));
        }

        return $addressNode;
    }

    private function createDetailedAddress(DomDocument $xml, stdClass $data)
    {
        $detailedAddress = $xml->createElement('detailedAddress');

        if (isset($data->region)) {
            $detailedAddress->appendChild($xml->createElement('region', $data->region));
        }

        $detailedAddress->appendChild($xml->createElement('district', $data->district ?? ''));

        if (isset($data->city)) {
            $detailedAddress->appendChild($xml->createElement('city', $data->city));
        }

        if (isset($data->locality)) {
            $detailedAddress->appendChild($xml->createElement('locality', $data->locality));
        }

        if (isset($data->street)) {
            $detailedAddress->appendChild($xml->createElement('street', $data->street));
        }

        $detailedAddress->appendChild($xml->createElement('house', $data->house));

        if (isset($data->building)) {
            $detailedAddress->appendChild($xml->createElement('building', $data->building));
        }

        if (isset($data->flat)) {
            $detailedAddress->appendChild($xml->createElement('flat', $data->flat));
        }

        if (isset($data->room)) {
            $detailedAddress->appendChild($xml->createElement('room', $data->room));
        }

        return $detailedAddress;
    }

    private function getXsdDate($date)
    {
        $time = strtotime($date);
        return date('Y-m-d', $time);
    }

    private function getAddressSlipRefusesData($addressSlipRefuses)
    {
        $result = [];

        if (is_array($addressSlipRefuses)) {
            foreach ($addressSlipRefuses as $addressSlipRefuse) {
                $result['AddressSlipRefuseType'][] = $this->getOneAddressSlipRefuseData($addressSlipRefuse);
            }

            return $result;
        }

        $result['AddressSlipRefuseType'] = $this->getOneAddressSlipRefuseData($addressSlipRefuses);

        return $result;
    }

    private function getOneAddressSlipRefuseData($addressSlipRefuse)
    {
        return [
            'prereqId' => $addressSlipRefuse->prereqId,
            'refuseReason' => $addressSlipRefuse->refuseReason,
        ];
    }

    private function getAddressSlipsData($addressSlips)
    {
        $result = [];
        if (is_array($addressSlips)) {
            foreach ($addressSlips as $slip) {
                $result['addressSlip'][] = $this->getOneAddressSlipData($slip);
            }

            return $result;
        }

        $result['addressSlip'] = $this->getOneAddressSlipData($addressSlips);

        return $result;
    }

    private function getOneAddressSlipData($addressSlip)
    {
        $result = [
            'prereqId' => $addressSlip->prereqId ?? '',
            'formType' => (int)($addressSlip->formType ?? -1),
            'regType' => (int)($addressSlip->regType ?? -1),
        ];

        $person = $addressSlip->person;
        $result['person'] = [
            'personId' => $person->personId ?? '',
            'lastName' => $person->lastName ?? '',
            'firstName' => $person->firstName ?? '',
            'middleName' => $person->middleName ?? '',
            'birthday' => $person->birthday ?? '',
            'sex' => $person->sex ?? '',
        ];

        $personBirthplace = $person->birthPlace;
        $result['person']['birthPlace'] = [
            'country' => [
                'type' => $personBirthplace->country->type ?? '',
                'element' => $personBirthplace->country->element ?? '',
                'value' => $personBirthplace->country->value ?? '',
            ],
            'region' => $personBirthplace->region ?? '',
            'district' => $personBirthplace->district ?? '',
            'city' => $personBirthplace->city ?? '',
            'locality' => $personBirthplace->locality ?? '',
        ];

        $idPaper = $addressSlip->idPaper;
        $result['idPaper'] = [
            'documentId' => $idPaper->documentId ?? '',
            'kindPaper' => [
                'type' => $idPaper->kindPaper->type ?? '',
                'element' => $idPaper->kindPaper->element ?? '',
                'value' => $idPaper->kindPaper->value ?? '',
            ],
            'series' => $idPaper->series ?? '',
            'number' => $idPaper->number ?? '',
            'issueDate' => $idPaper->issueDate ?? '',
            'issuesRegOrgan' => [
                'name' => [
                    'type' => $idPaper->issuesRegOrgan->name->type ?? '',
                    'element' => $idPaper->issuesRegOrgan->name->element ?? '',
                    'value' => $idPaper->issuesRegOrgan->name->value ?? '',
                ],
                'code' => $idPaper->issuesRegOrgan->code ?? '',
            ],
            'sideInformation' => $idPaper->sideInformation ?? '',
        ];

        $territorialRegOrgan = $addressSlip->territorialRegOrgan;
        $result['territorialRegOrgan'] = [
            'name' => [
                'type' => $territorialRegOrgan->name->type ?? '',
                'element' => $territorialRegOrgan->name->element ?? '',
                'value' => $territorialRegOrgan->name->value ?? '',
            ],
            'code' => $territorialRegOrgan->code ?? '',
        ];

        $registrationAddress = $addressSlip->registrationAddress;
        $result['registrationAddress'] = [
            'country' => [
                'type' => $registrationAddress->country->type ?? '',
                'element' => $registrationAddress->country->element ?? '',
                'value' => $registrationAddress->country->value ?? '',
            ],
            'detailedAddress' => [
                'region' => $registrationAddress->detailedAddress->region ?? '',
                'district' => $registrationAddress->detailedAddress->district ?? '',
                'city' => $registrationAddress->detailedAddress->city ?? '',
                'locality' => $registrationAddress->detailedAddress->locality ?? '',
                'street' => $registrationAddress->detailedAddress->street ?? '',
                'house' => $registrationAddress->detailedAddress->house ?? '',
                'building' => $registrationAddress->detailedAddress->building ?? '',
                'flat' => $registrationAddress->detailedAddress->flat ?? '',
                'room' => $registrationAddress->detailedAddress->room ?? '',
            ],
            'easPrefix' => (int)($registrationAddress->easPrefix ?? -1),
            'easCode' => (int)($registrationAddress->easCode ?? -1),
            'ovirugId' => (int)($registrationAddress->ovirugId ?? -1),
            'addressString' => $registrationAddress->addressString,
            'startingDate' => $registrationAddress->startingDate ?? '',
            'endingDate' => $registrationAddress->endingDate ?? '',
        ];

        $fromToAddress = $addressSlip->fromToAddress;
        $result['fromToAddress'] = [
            'country' => [
                'type' => $fromToAddress->country->type ?? '',
                'element' => $fromToAddress->country->element ?? '',
                'value' => $fromToAddress->country->value ?? '',
            ],
            'detailedAddress' => [
                'region' => $fromToAddress->detailedAddress->region ?? '',
                'district' => $fromToAddress->detailedAddress->district ?? '',
                'city' => $fromToAddress->detailedAddress->city ?? '',
                'locality' => $fromToAddress->detailedAddress->locality ?? '',
                'street' => $fromToAddress->detailedAddress->street ?? '',
                'house' => $fromToAddress->detailedAddress->house ?? '',
                'building' => $fromToAddress->detailedAddress->building ?? '',
                'flat' => $fromToAddress->detailedAddress->flat ?? '',
                'room' => $fromToAddress->detailedAddress->room ?? '',
            ],
            'easPrefix' => (int)($fromToAddress->easPrefix ?? -1),
            'easCode' => (int)($fromToAddress->easCode ?? -1),
            'ovirugId' => (int)($fromToAddress->ovirugId ?? -1),
            'addressString' => $fromToAddress->addressString,
            'startingDate' => $fromToAddress->startingDate ?? '',
            'endingDate' => $fromToAddress->endingDate ?? '',
        ];

        $result['regActionDate'] = $addressSlip->regActionDate ?? '';
        $result['changeData'] = [
            'changeDataOther' => $addressSlip->changeData->changeDataOther ?? '',
        ];
        $result['reason'] = $addressSlip->reason ?? '';

        return $result;
    }

}