<?php

namespace App;

class Soap
{

    private $cp;
    private $data;
    private $curl;

    public function __construct()
    {
        $this->cp = new CryptoPro();

        if (!$this->cp->verify(file_get_contents("php://input"))) {
            App::$log->log('error', 'CryptoPro Не верная ЭП сообщения');
            App::$parser->dropError('SMEV-100003', 'Не верная ЭП сообщения');
        }

        $this->data = new Data();
        $this->curl = new Curl();

    }

    public function GetForm9Async($request_data)
    {

        $values = $this->data->prepareFormValues($request_data);

        $result = $this->curl->postJsonToOvirug($values);

        $prepared_data = $this->data->prepareForm9Result($result);

        App::$parser->generateSoapResponse($prepared_data);
    }

    public function GetForm7Async($request_data)
    {
        $values = $this->data->prepareFormValues($request_data);

        $result = $this->curl->postJsonToOvirug($values, true, '');

        $prepared_data = $this->data->prepareForm7Result($result);

        App::$parser->generateSoapResponse($prepared_data);
    }

    public function GetForm9Sync($request_data)
    {
        $values = $this->data->prepareFormValues($request_data);

        $result = $this->curl->postJsonToOvirug($values, false);

        $response = $this->data->prepareFormSyncResult($result, $values["type"]);

        $prepared_data = $this->data->prepareForm9SyncResult($response);

        App::$parser->generateSoapResponse($prepared_data);
    }

    public function GetForm7Sync($request_data)
    {
        $values = $this->data->prepareFormValues($request_data);

        $result = $this->curl->postJsonToOvirug($values, false);

        $response = $this->data->prepareFormSyncResult($result, $values["type"]);

        $prepared_data = $this->data->prepareForm7SyncResult($response);

        App::$parser->generateSoapResponse($prepared_data);
    }

    public function GetStatus($request_data)
    {
        $result = $this->curl->getStatus($request_data->id);

        $prepared_data = $this->data->prepareGetStatusResult($result);

        App::$parser->generateSoapResponse($prepared_data);
    }

    public function processCanonicalService($request_data)
    {
        $data = $this->data->unZipData($request_data->MessageData->AppDocument->BinaryData);

        $values = $this->data->prepareZDDKValues($data);

        $result = $this->curl->postJsonToOvirug($values);

        if (empty($result)) {

            App::$log->log('error', 'SMEV-300001 Нет данных на стороне поставщика');
            App::$parser->dropError('SMEV-300001', 'Нет данных на стороне поставщика');

        } else {

            $base_name = '../tmp/' . time() . rand(0, 99999);

            $zipBase64 = $this->data->prepareZddkZip($result, $values, $base_name);

            $prepared_data = $this->data->prepareZddkResponse($request_data, $zipBase64, $base_name);

            App::$parser->generateSoapResponse($prepared_data);

        }
    }

    public function GetContract($request_data)
    {
        $data = $this->data->unZipData($request_data->MessageData->AppDocument->BinaryData);

        $values = $this->data->prepareDNValues($data);

        $result = $this->curl->postJsonToOvirug($values, true);

        if (empty($result)) {

            App::$parser->dropError('SMEV-300001', 'Нет данных на стороне поставщика');

        } else {

            $base_name = time() . rand(0, 99999);

            $zipBase64 = $this->data->prepareContractsZip($result, $base_name);

            $prepared_data = $this->data->prepareContractsResponse($request_data, $zipBase64, $base_name);

            App::$parser->generateSoapResponse($prepared_data);

        }
    }

    public function getReferenceInfo($request_data)
    {

        if ($formNumber = $request_data->MessageData->AppData->Request->formNumber ?? null) {
            $referenceInfo = $this->curl->getJsonToOvirug( json_encode( ['form_number' => (string) $formNumber] ) , 'check_form');
        } else {
            App::$parser->dropError('SMEV-100001', 'Не указан номер справки');
        }

        $prepared_data = $this->data->prepareCheckReferenceData($request_data, $referenceInfo);

        App::$parser->generateSoapResponse($prepared_data, 'checkreference');

    }

}