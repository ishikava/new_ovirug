<?php


namespace App;


class Test
{

    private $host = 'http://127.0.0.1';

    public function __construct()
    {

        $this->tests = json_decode(file_get_contents(__DIR__ . '/../routes.json'), true);

    }

    public function run($test_name, $url, $data)
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->host.$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($curl);
        curl_close($curl);

        echo 'Тест : '.$test_name . ' | ' . $this->host.$url . ' | ' . $data.PHP_EOL;
        echo $res.PHP_EOL;
        echo '=====================================================================';

    }

}