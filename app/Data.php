<?php

namespace App;

use DOMDocument;
use ZipArchive;

class Data
{

    public function prepareGpruResult($request_data)
    {

        return '';

    }

    public function prepareFormValues($request_data)
    {
        $values = [
            "last_name" => $request_data->person->LastName,
            "first_name" => $request_data->person->FirstName,
            "second_name" => $request_data->person->SecondName,
            "birth_date" => date('d.m.Y', strtotime($request_data->person->BirthDate)),
            "street_code" => $request_data->address->Street->Code,
            "street_name" => $request_data->address->Street->Name,
            "house" => $request_data->address->House,
            "flat" => $request_data->address->Flat,
            "type" => $request_data->typeFile ?? "html",
        ];
        if (!empty($request_data->address->Block)) {
            $values["block"] = $request_data->address->Block;
        }

        return $values;
    }

    public function prepareForm9Result($result)
    {
        return '
<GetForm9AsyncResponse xmlns="http://tempuri.org/">
    <GetForm9AsyncResult xmlns:d4p1="http://schemas.datacontract.org/2004/07/GetForm9ASync">
        <d4p1:ID>' . $result->request_id . '</d4p1:ID>
        <d4p1:Fault>
            <d4p1:Code>' . $result->code . '</d4p1:Code>
            <d4p1:Name>' . $result->message . '</d4p1:Name>
        </d4p1:Fault>
    </GetForm9AsyncResult>
</GetForm9AsyncResponse>';
    }

    public function prepareForm7Result($result)
    {
        return '
<GetForm7AsyncResponse xmlns="http://tempuri.org/">
    <GetForm7AsyncResult xmlns:d4p1="http://schemas.datacontract.org/2004/07/GetForm7ASync">
        <d4p1:ID>' . $result->request_id . '</d4p1:ID>
        <d4p1:Fault>
            <d4p1:Code>' . $result->code . '</d4p1:Code>
            <d4p1:Name>' . $result->message . '</d4p1:Name>
        </d4p1:Fault>
    </GetForm7AsyncResult>
</GetForm7AsyncResponse>';
    }

    public function prepareForm9SyncResult($response)
    {
        return '
<GetForm9SyncResponse xmlns="http://tempuri.org/">
    <GetForm9SyncResult xmlns:d4p1="http://schemas.datacontract.org/2004/07/GetForm9Sync" xmlns:a="http://schemas.datacontract.org/2004/07/GetForm9Sync" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
        ' . $response . '
    </GetForm9SyncResult>
</GetForm9SyncResponse>';
    }

    public function prepareForm7SyncResult($response)
    {
        return '
<GetForm7SyncResponse xmlns="http://tempuri.org/">
    <GetForm7SyncResult xmlns:d4p1="http://schemas.datacontract.org/2004/07/GetForm7Sync" xmlns:a="http://schemas.datacontract.org/2004/07/GetForm7Sync" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
        ' . $response . '
    </GetForm7SyncResult>
</GetForm7SyncResponse>';
    }

    public function prepareFormSyncResult($result, $type)
    {
        $json = json_decode($result);

        $pdf_data = $json->filedata;

        if ($pdf_data) {

            $cp = new CryptoPro();
            $zip = $cp->getSignedZipBase64($pdf_data, $type);
            $response = '<d4p1:Document>' . $zip . '</d4p1:Document>
        <d4p1:Status>
            <d4p1:Code>1</d4p1:Code>
            <d4p1:Name>Запрос успешно обработан</d4p1:Name>
        </d4p1:Status>';

        } elseif (!$json) {

            $cp = new CryptoPro();
            $zip = $cp->getSignedZipBase64($result, $type);
            $response = '<d4p1:Document>' . $zip . '</d4p1:Document>
        <d4p1:Status>
            <d4p1:Code>1</d4p1:Code>
            <d4p1:Name>Запрос успешно обработан</d4p1:Name>
        </d4p1:Status>';

        } else {

            $response = '
        <d4p1:Status>
            <d4p1:Code>' . $json->code . '</d4p1:Code>
            <d4p1:Name>' . $json->message . '</d4p1:Name>
        </d4p1:Status>';

        }

        return $response;
    }

    public function prepareGetStatusResult($result)
    {
        if (isset($result->filedata)) {
            $response = '<d4p1:Document>' . $result->filedata . '</d4p1:Document>
        <d4p1:Status>
            <d4p1:Code>4</d4p1:Code>
            <d4p1:Name>Запрос успешно обработан</d4p1:Name>
        </d4p1:Status>';
        } else {
            $response = '<d4p1:Document nil="true" />
        <d4p1:Status>
            <d4p1:Code>' . $result->code . '</d4p1:Code>
            <d4p1:Name>' . $result->message . '</d4p1:Name>
        </d4p1:Status>';
        }

        $router = new Router();

        if ($router::$model == 'form_7async') {
            $ns = 'GetForm7ASync';
        } else {
            $ns = 'GetForm9ASync';
        }

        $prepared_data = '
<GetStatusResponse xmlns="http://tempuri.org/">
    <GetStatusResult xmlns:d4p1="http://schemas.datacontract.org/2004/07/' . $ns . '" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
    ' . $response . '
    </GetStatusResult>
</GetStatusResponse>';

        return $prepared_data;
    }

    public function prepareZDDKValues($request_data)
    {

        $values = [
            "region_code" => !empty($request_data->regionCode) ? (string)$request_data->regionCode : "78",
            "object_city" => !empty($request_data->objectTown) ? (string)$request_data->objectTown : "",
            "object_street" => !empty($request_data->objectStreet) ? (string)$request_data->objectStreet : "",
            "object_house" => !empty($request_data->objectHouse) ? (string)$request_data->objectHouse : "",
            "object_district" => !empty($request_data->objectDistrict) ? (string)$request_data->objectDistrict : "",
            "object_town" => !empty($request_data->objectCity) ? (string)$request_data->objectCity : "",
            "object_corpus" => !empty($request_data->objectCorpus) ? (string)$request_data->objectCorpus : "",
            "object_building" => !empty($request_data->objectBuilding) ? (string)$request_data->objectBuilding : "",
            "object_flat" => !empty($request_data->objectFlat) ? (string)$request_data->objectFlat : "",
            "object_cadastr_number" => !empty($request_data->objectCadastrNumber) ? (string)$request_data->objectCadastrNumber : "",
            "object_condit_number" => !empty($request_data->objectConditNumber) ? (string)$request_data->objectConditNumber : "",
        ];

        return $values;
    }

    public function prepareDNValues($request_data)
    {
        $values = [
            "okato" => !empty($request_data->OKATO) ? (string)$request_data->OKATO : "",
            "district" => !empty($request_data->District) ? (string)$request_data->District : "",
            "city" => !empty($request_data->City) ? (string)$request_data->City : "",
            "locality" => !empty($request_data->Locality) ? (string)$request_data->Locality : "",
            "street" => !empty($request_data->Street) ? (string)$request_data->Street : "",
            "house" => !empty($request_data->House) ? (string)$request_data->House : "",
            "building" => !empty($request_data->Building) ? (string)$request_data->Building : "",
            "structure" => !empty($request_data->Structure) ? (string)$request_data->Structure : "",
            "flat" => !empty($request_data->Flat) ? (string)$request_data->Flat : "",
        ];

        return $values;
    }

    public function prepareContractsResponse($request_data, $zip, $base_name)
    {
        return '<dkResponse xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>' . (!empty($request_data->Message->Recipient->Code) ? $request_data->Message->Recipient->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Recipient->Name) ? $request_data->Message->Recipient->Name : "") . '</Name>
            </Sender>
            <Recipient>
               <Code>' . (!empty($request_data->Message->Sender->Code) ? $request_data->Message->Sender->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Sender->Name) ? $request_data->Message->Sender->Name : "") . '</Name>
            </Recipient>
            <Originator>
               <Code>' . (!empty($request_data->Message->Originator->Code) ? $request_data->Message->Originator->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Originator->Name) ? $request_data->Message->Originator->Name : "") . '</Name>
            </Originator>
            <TypeCode>GSRV</TypeCode>
            <Status>RESULT</Status>
            <Date>' . date('Y-m-d', time()) . 'T' . date('H:i:s', time()) . '.0000+03:00</Date>
            <ExchangeType>2</ExchangeType>
            <RequestIdRef>D4A9D2F4-0EDA-43D1-B4E1-DB653C0ACE19</RequestIdRef>
            <OriginRequestIdRef>D4A9D2F4-0EDA-43D1-B4E1-DB653C0ACE19</OriginRequestIdRef>
            <ServiceCode/>
            <CaseNumber/>
         </Message>
         <MessageData xmlns="http://smev.gosuslugi.ru/rev120315">
            <AppData/>
            <AppDocument>
               <RequestCode>' . $base_name . '</RequestCode>
               <BinaryData>' . $zip . '</BinaryData>
            </AppDocument>
         </MessageData>
      </dkResponse>
';
    }

    public function prepareZddkResponse($request_data, $zip, $name)
    {
        return '<processCanonicalServiceResponse xmlns="http://ec.minregion.ru/">
         <Message xmlns="http://smev.gosuslugi.ru/rev120315">
            <Sender>
               <Code>' . (!empty($request_data->Message->Recipient->Code) ? $request_data->Message->Recipient->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Recipient->Name) ? $request_data->Message->Recipient->Name : "") . '</Name>
            </Sender>
            <Recipient>
               <Code>' . (!empty($request_data->Message->Sender->Code) ? $request_data->Message->Sender->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Sender->Name) ? $request_data->Message->Sender->Name : "") . '</Name>
            </Recipient>
            <Originator>
               <Code>' . (!empty($request_data->Message->Originator->Code) ? $request_data->Message->Originator->Code : "") . '</Code>
               <Name>' . (!empty($request_data->Message->Originator->Name) ? $request_data->Message->Originator->Name : "") . '</Name>
            </Originator>
            <TypeCode>GSRV</TypeCode>
            <Status>RESULT</Status>
            <Date>' . date('Y-m-d', time()) . 'T' . date('H:i:s', time()) . '.0000+03:00</Date>
            <ExchangeType>2</ExchangeType>
            <RequestIdRef>D874BD51-FDC9-4226-971D-5A1D78A84B76</RequestIdRef>
            <OriginRequestIdRef>D874BD51-FDC9-4226-971D-5A1D78A84B76</OriginRequestIdRef>
            <ServiceCode/>
            <CaseNumber/>
         </Message>
         <MessageData xmlns="http://smev.gosuslugi.ru/rev120315">
            <AppData>
               <errorCode>0</errorCode>
            </AppData>
            <AppDocument>
               <RequestCode>' . $name . '</RequestCode>
               <BinaryData>' . $zip . '</BinaryData>
            </AppDocument>
         </MessageData>
      </processCanonicalServiceResponse>
';
    }

    public function unZipData($binaryData)
    {
        $name = '../tmp/' . time() . rand(0, 99999) . 'zddk.zip';
        $fp = fopen($name, 'w');
        fwrite($fp, $binaryData);
        $zip = new ZipArchive;
        $zip->open($name);
        $result = simplexml_load_string($zip->getFromIndex(0));

        $zip->close();
        fclose($fp);
        unlink($name);

        return $result;
    }

    public function prepareContractsZip($result, $base_name)
    {
        $cp = new CryptoPro();

        $i = 0;

        $nameOfContract = [];

        foreach ($result as $contract) {
            $xml = $this->createXMLContract($contract);
            $nameOfContract[] = $base_name . '_contract_' . $i . '.xml';
            $xml->save('../tmp/' . $base_name . '_contract_' . $i . '.xml');
            $cp->signExec('../tmp/' . $base_name . '_contract_' . $i . '.xml');
            $i++;
        }

        $xmlWarp = $this->createXMLWrap($nameOfContract);
        $xmlWarp->save('../tmp/' . $base_name . '_response.xml');
        $cp->signExec('../tmp/' . $base_name . '_response.xml');

        $zip = new ZipArchive();
        $zip->open('../tmp/' . $base_name . '_response.zip', ZipArchive::CREATE);
        $zip->addFile('../tmp/' . $base_name . '_response.xml', $base_name . '_response.xml');
        $zip->addFile('../tmp/' . $base_name . '_response.xml.sig', $base_name . '_response.xml.sig');

        foreach ($nameOfContract as $file) {
            $zip->addFile('../tmp/' . $file, $file);
            $zip->addFile('../tmp/' . $file . '.sig', $file . '.sig');
        }

        $zip->close();

        $zip = file_get_contents('../tmp/' . $base_name . '_response.zip');

        if (file_exists('../tmp/' . $base_name . '_response.xml')) {
            unlink('../tmp/' . $base_name . '_response.xml');
        }
        if (file_exists('../tmp/' . $base_name . '_response.xml.sig')) {
            unlink('../tmp/' . $base_name . '_response.xml.sig');
        }
        if (file_exists('../tmp/' . $base_name . '_response.zip')) {
            unlink('../tmp/' . $base_name . '_response.zip');
        }

        foreach ($nameOfContract as $fileContr) {
            if (file_exists('../tmp/' .$fileContr)) {
                unlink('../tmp/' .$fileContr);
            }
            if (file_exists('../tmp/' .$fileContr. '.sig')) {
                unlink('../tmp/' .$fileContr . '.sig');
            }
        }

        return base64_encode($zip);
    }

    public function prepareZddkZip($result, $values, $base_name)
    {
        $cp = new CryptoPro();

        $tmpname = '../tmp/' . $base_name . '.xml';

        $xml = $this->createXMLZddk($result, $values);
        $xml->save($tmpname);

        $cp->signExec($tmpname);

        $zip = new ZipArchive();
        $zip->open($tmpname . '.zip', ZipArchive::CREATE);
        $zip->addFile($tmpname, $base_name . '.xml');
        $zip->addFile($tmpname . '.sig', $base_name . '.xml.sig');
        $zip->close();

        $zip = file_get_contents($tmpname . '.zip');

        if (file_exists($tmpname)) {
            unlink($tmpname);
        }
        if (file_exists($tmpname . '.sig')) {
            unlink($tmpname . '.sig');
        }
        if (file_exists($tmpname . '.zip')) {
            unlink($tmpname . '.zip');
        }

        return base64_encode($zip);
    }

    public function prepareCheckReferenceData($request_data, $referenceInfo)
    {

        if ($referenceInfo && !isset($referenceInfo->error)) {
            $data = '<ns2:Result>
                  <ns2:user>' . $referenceInfo->user . '</ns2:user>
                  <ns2:formType>' . $referenceInfo->form_type . '</ns2:formType>
                  <ns2:address>' . $referenceInfo->address . '</ns2:address>
                  <ns2:printDate>' . $referenceInfo->print_date . '</ns2:printDate>
                  <ns2:fio>' . $referenceInfo->print_date . '</ns2:fio>
               </ns2:Result>';
        } else {

            if (isset($referenceInfo->error)) {
                $data = '<ns2:Error>
                  <ns2:errorMessage>' . $referenceInfo->error . '</ns2:errorMessage>
               </ns2:Error>';
            } else {
                $data = '<ns2:Error>
                  <ns2:errorMessage>No information</ns2:errorMessage>
               </ns2:Error>';
            }

        }

        $result = '<ns1:getReferenceInfoResponse>
         <ns1:Message>
            <ns1:Sender>
               <ns1:Code>IAC</ns1:Code>
               <ns1:Name>IAC</ns1:Name>
            </ns1:Sender>
            <ns1:Recipient>
               <ns1:Code>' . $request_data->Message->Sender->Code . '</ns1:Code>
               <ns1:Name>' . $request_data->Message->Sender->Name . '</ns1:Name>
            </ns1:Recipient>
            <ns1:Originator>
               <ns1:Code>' . $request_data->Message->Originator->Code . '</ns1:Code>
               <ns1:Name>' . $request_data->Message->Originator->Name . '</ns1:Name>
            </ns1:Originator>
            <ns1:Service>
               <ns1:Mnemonic>Check reference</ns1:Mnemonic>
               <ns1:Version>1.0</ns1:Version>
            </ns1:Service>
            <ns1:TypeCode>GSRV</ns1:TypeCode>
            <ns1:Status>RESULT</ns1:Status>
            <ns1:Date>' . date('Y-m-d', time()) . 'T' . date('H:i:s', time()) . '.0000+03:00</ns1:Date>
            <ns1:ExchangeType>2</ns1:ExchangeType>
         </ns1:Message>
         <ns1:MessageData>
            <ns1:AppData>' . $data . '
            </ns1:AppData>
         </ns1:MessageData>
      </ns1:getReferenceInfoResponse>';

        return $result;
    }

    private function createXMLContract($contract)
    {
        $xml = new DomDocument('1.0', 'utf-8');

        $contractType = $xml->appendChild($xml->createElement('ContractType'));

        $objectDescription = $contractType->appendChild($xml->createElement('ObjectDescription'));
        $objectAddress = $contractType->appendChild($xml->createElement('ObjectAddress'));
        $employers = $contractType->appendChild($xml->createElement('Employers'));

        $objectDescription->appendChild($xml->createElement('ContractSeries',
            !empty($contract->ContractSeries) ? $contract->ContractSeries : ""));
        $objectDescription->appendChild($xml->createElement('ContractNumber',
            !empty($contract->ContractNumber) ? $contract->ContractNumber : ""));
        $objectDescription->appendChild($xml->createElement('ContractType',
            !empty($contract->ContractType) ? $contract->ContractType : ""));
        $objectDescription->appendChild($xml->createElement('Name', !empty($contract->Name) ? $contract->Name : ""));
        $objectDescription->appendChild($xml->createElement('Purpose',
            !empty($contract->Purpose) ? $contract->Purpose : ""));
        $objectDescription->appendChild($xml->createElement('TotalArea',
            !empty($contract->TotalArea) ? $contract->TotalArea : ""));
        $objectDescription->appendChild($xml->createElement('LiveArea',
            !empty($contract->LiveArea) ? $contract->LiveArea : ""));

        $objectAddress->appendChild($xml->createElement('Region',
            !empty($contract->address->Region) ? $contract->address->Region : ""));
        $objectAddress->appendChild($xml->createElement('District',
            !empty($contract->address->District) ? $contract->address->District : ""));
        $objectAddress->appendChild($xml->createElement('City',
            !empty($contract->address->City) ? $contract->address->City : ""));
        $objectAddress->appendChild($xml->createElement('Locality',
            !empty($contract->address->Locality) ? $contract->address->Locality : ""));
        $objectAddress->appendChild($xml->createElement('Street',
            !empty($contract->address->Street) ? $contract->address->Street : ""));
        $objectAddress->appendChild($xml->createElement('House',
            !empty($contract->address->House) ? $contract->address->House : ""));
        $objectAddress->appendChild($xml->createElement('Building',
            !empty($contract->address->Building) ? $contract->address->Building : ""));
        $objectAddress->appendChild($xml->createElement('Structure',
            !empty($contract->address->Structure) ? $contract->address->Structure : ""));
        $objectAddress->appendChild($xml->createElement('Flat',
            !empty($contract->address->Flat) ? $contract->address->Flat : ""));

        if (isset($contract->employers)) {
            // Employer. Loop through the data, and add each record to the Employer object
            foreach ($contract->employers as $member) {
                $employer = $employers->appendChild($xml->createElement('Employer'));

                $employer->appendChild($xml->createElement('LastName',
                    !empty($member->LastName) ? $member->LastName : ""));
                $employer->appendChild($xml->createElement('FirstName',
                    !empty($member->FirstName) ? $member->FirstName : ""));
                $employer->appendChild($xml->createElement('MiddleName',
                    !empty($member->MiddleName) ? $member->MiddleName : ""));
                $employer->appendChild($xml->createElement('Birthday',
                    !empty($member->Birthday) ? $member->Birthday : ""));
                $employer->appendChild($xml->createElement('Birthplace',
                    !empty($member->Birthplace) ? $member->Birthplace : ""));
                $employer->appendChild($xml->createElement('Citizenship',
                    !empty($member->Citizenship) ? $member->Citizenship : ""));
                $employer->appendChild($xml->createElement('DocumentType',
                    !empty($member->DocumentType) ? $member->DocumentType : ""));
                $employer->appendChild($xml->createElement('DocumentNumber',
                    !empty($member->DocumentNumber) ? $member->DocumentNumber : ""));
                $employer->appendChild($xml->createElement('DocumentSeries',
                    !empty($member->DocumentSeries) ? $member->DocumentSeries : ""));
                $employer->appendChild($xml->createElement('DocumentDate',
                    !empty($member->DocumentDate) ? $member->DocumentDate : ""));
            }
        }

        return $xml;
    }

    private function createXMLWrap($nameOfContract)
    {
        $xmlWarp = new DomDocument('1.0', 'utf-8');
        $resultRoot = $xmlWarp->appendChild($xmlWarp->createElement('Result'));
        $resultRoot->appendChild($xmlWarp->createElement('Status', 1));
        $resultRoot->appendChild($xmlWarp->createElement('Comment'));
        $resultRoot->appendChild($xmlWarp->createElement('Number'));
        $appliedDocuments = $resultRoot->appendChild($xmlWarp->createElement('AppliedDocuments'));

        foreach ($nameOfContract as $item) {
            $appliedDocument = $appliedDocuments->appendChild($xmlWarp->createElement('AppliedDocument'));

            $appliedDocument->appendChild($xmlWarp->createElement('CodeDocument'));
            $appliedDocument->appendChild($xmlWarp->createElement('Name', $item));
            $appliedDocument->appendChild($xmlWarp->createElement('Number'));
            $appliedDocument->appendChild($xmlWarp->createElement('URL'));
            $appliedDocument->appendChild($xmlWarp->createElement('Type', 'xml'));
            $appliedDocument->appendChild($xmlWarp->createElement('DigestValue', ''));
        }

        return $xmlWarp;
    }

    private function createXMLZddk($result, $values)
    {
        $xml = new DomDocument('1.0', 'utf-8');

        $housebook = $xml->appendChild($xml->createElement('housebookExtractionResponse'));

        $housebook->appendChild($xml->createElement('regionCode', (string)$values["region_code"]));
        $housebook->appendChild($xml->createElement('objectDistrict', (string)$values["object_district"]));
        $housebook->appendChild($xml->createElement('objectCity', (string)$values["object_city"]));
        $housebook->appendChild($xml->createElement('objectTown', (string)$values["object_town"]));
        $housebook->appendChild($xml->createElement('objectStreet', (string)$values["object_street"]));
        $housebook->appendChild($xml->createElement('objectHouse', (string)$values["object_house"]));
        $housebook->appendChild($xml->createElement('objectCorpus', (string)$values["object_corpus"]));
        $housebook->appendChild($xml->createElement('objectBuilding', (string)$values["object_building"]));
        $housebook->appendChild($xml->createElement('objectFlat', (string)$values["object_flat"]));
        $housebook->appendChild($xml->createElement('objectCadastrNumber', (string)$values["object_cadastr_number"]));
        $housebook->appendChild($xml->createElement('objectConditNumber', (string)$values["object_condit_number"]));

        // Owner. Loop through the data, and add each record to the Owner object
        if (isset($result->Owner)) {
            foreach ($result->Owner AS $members) {
                $owner = $housebook->appendChild($xml->createElement('Owner'));
                $owner->appendChild($xml->createElement('lastName',
                    !empty($members->lastName) ? $members->lastName : ""));
                $owner->appendChild($xml->createElement('firstName',
                    !empty($members->firstName) ? $members->firstName : ""));
                $owner->appendChild($xml->createElement('givenName',
                    !empty($members->givenName) ? $members->givenName : ""));
                $owner->appendChild($xml->createElement('type', !empty($members->type) ? $members->type : ""));
                $owner->appendChild($xml->createElement('share', !empty($members->share) ? $members->share : ""));
                $owner->appendChild($xml->createElement('size', !empty($members->size) ? $members->size : ""));
                $owner->appendChild($xml->createElement('since', !empty($members->since) ? $members->since : ""));
            }
        }

        // registeredPerson. Loop through the data, and add each record to the registeredPerson object
        if (isset($result->RegisteredPerson)) {
            foreach ($result->RegisteredPerson AS $members) {
                $registeredPerson = $housebook->appendChild($xml->createElement('registeredPerson'));
                $registeredPerson->appendChild($xml->createElement('lastName',
                    !empty($members->lastName) ? $members->lastName : ""));
                $registeredPerson->appendChild($xml->createElement('firstName',
                    !empty($members->firstName) ? $members->firstName : ""));
                $registeredPerson->appendChild($xml->createElement('givenName',
                    !empty($members->givenName) ? $members->givenName : ""));
                $registeredPerson->appendChild($xml->createElement('birthday',
                    !empty($members->birthday) ? $members->birthday : ""));
                $registeredPerson->appendChild($xml->createElement('birthPlace',
                    !empty($members->birthPlace) ? $members->birthPlace : ""));
                $registeredPerson->appendChild($xml->createElement('docType',
                    !empty($members->docType) ? $members->docType : ""));
                $registeredPerson->appendChild($xml->createElement('docSerie',
                    !empty($members->docSerie) ? $members->docSerie : ""));
                $registeredPerson->appendChild($xml->createElement('docNumber',
                    !empty($members->docNumber) ? $members->docNumber : ""));
                $registeredPerson->appendChild($xml->createElement('docIssueDate',
                    !empty($members->lastName) ? $members->lastName : ""));
                $registeredPerson->appendChild($xml->createElement('docIssuer',
                    !empty($members->docIssueDate) ? $members->docIssueDate : ""));
                $registeredPerson->appendChild($xml->createElement('checkinDate',
                    !empty($members->checkinDate) ? $members->checkinDate : ""));
                $registeredPerson->appendChild($xml->createElement('checkoutDate',
                    !empty($members->checkoutDate) ? $members->checkoutDate : ""));
            }
        }

        return $xml;
    }

}