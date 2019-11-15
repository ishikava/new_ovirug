<?php

namespace App;

use SoapClient;

class Esun
{

    public function pre_registration($request_data)
    {

        $data = new EsunData();

        try {
            $client = new SoapClient(App::$config->get('esun'), ['trace' => true, 'connection_timeout' => 3]);
        } catch (\Exception $e) {
            App::$log->log('error', 'LMA ' . $e->getMessage());
            App::$parser->dropJsonError('1', $e->getMessage());
        }

        $params = $data->prepareParams($request_data);

        App::$log->log('error', 'LMA ' . $params);
        var_dump($params);die();

        try {
            $result = $client->executeInteraction($params);
        } catch (\Exception $e) {
            App::$log->log('error', 'LMA ' . $e->getMessage());
            App::$parser->dropJsonError('2', $e->getMessage());
        }

        if (isset($result->responseDocument->any) && $response = simplexml_load_string($result->responseDocument->any,
                null, null, 'urn:eis:cprp:oviru:DataObjects')) {
            App::$parser->generateJsonResponse($response);
        } else {
            App::$log->log('error', 'LMA Сервис ЛМА не доступен');
            App::$parser->dropJsonError('3', 'Сервис ЛМА не доступен');
        }

    }



}