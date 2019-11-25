<?php


namespace App;


class Curl
{

    public function getToken()
    {
        $url = App::$config->get('ovirug_host') . App::$config->get('ovirug_login_path');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,
            "_username=" . App::$config->get('ovirug_login') . "&_password=" . App::$config->get('ovirug_pass'));
        $res = curl_exec($curl);
        curl_close($curl);

        if (!$res) {
            App::$log->log('error', 'OVIRUG Не удалось получить токен');
        }

        return json_decode($res);
    }

    public function postJsonToOvirug($values, $decode = true, $config = null, $url = null)
    {

        $token = $this->getToken();

        $config = $config ? $config : Router::$model;

        $url = $url ? $url : App::$config->get('ovirug_host') . App::$config->get($config);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json', 'Authorization: Bearer ' . $token->token));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode((object)$values, JSON_UNESCAPED_UNICODE));
        $res = curl_exec($curl);
        curl_close($curl);

        if (!$res) {

            App::$log->log('error', 'OVIRUG Не удалось выполнить запрос JSON CURL');
            App::$parser->dropError('SMEV-300001', 'Нет данных на стороне поставщика');

        }

        if (isset($res->message) && stripos($res->message, 'error')) {

            App::$log->log('error', 'OVIRUG Ошибка на стороне поставщика, code : ' . $res->code . ', message : ' . $res->message);
            App::$parser->dropError('SMEV-300001', 'Нет данных на стороне поставщика');

        }

        return $decode ? json_decode($res) : $res;
    }

    public function getStatus($id)
    {
        $token = $this->getToken();

        $url = App::$config->get('ovirug_host') . App::$config->get('form_status') . $id;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json', 'Authorization: Bearer ' . $token->token));
        $res = curl_exec($curl);
        curl_close($curl);

        if (!$res) {
            App::$log->log('error', 'OVIRUG Не удалось выполнить запрос CURL');
        }

        return json_decode($res);
    }

    public function getJsonToOvirug($params, $config, $decode = true)
    {
        $token = $this->getToken();

        $url = App::$config->get('ovirug_host') . App::$config->get($config);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json', 'Authorization: Bearer ' . $token->token));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $res = curl_exec($curl);
        curl_close($curl);

        if (!$res) {
            App::$log->log('error', 'OVIRUG Не удалось выполнить запрос JSON CURL');
        }

        return $decode ? json_decode($res) : $res;
    }
}