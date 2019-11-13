<?php


namespace App;


class Parser
{

    public function dropJsonError($code, $message)
    {
        echo json_encode(['error_code' => $code, 'error' => $message], JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function dropError($code, $message)
    {
        $this->generateSoapResponse('
<SoapFault xmlns:d4p1="http://schemas.datacontract.org/2004/07/SoapFault">
    <d4p1:Fault>
        <d4p1:Code>' . $code . '</d4p1:Code>
        <d4p1:Name>' . $message . '</d4p1:Name>
    </d4p1:Fault>
</SoapFault>');

        App::$log->log('error', $code . ' ' . $message);
    }

    public function generateSoapResponse($data, $tpl = false)
    {
        $cp = new CryptoPro();
        $cert = $cp->getCertificate();

        $content = $this->prepareTemplate($data, $cert, $tpl);

        $envelope = $cp->signXML($content);

        /*
         * Приходится выходить из программы прямо здесь, иначе соап сервер будет возвращать свой убогий ответ.
         * А нам этого не надо, мы пошли простым путем - парсим шаблоны.
         * Если интересно почему:
         * Попробуйте средствами Soap и Xml сгенерировать корректный конверт, ответ станет очевиден.
         */

        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Length: ' . strlen($envelope));

        echo $envelope;

        App::$log->log('access', '200 OK SOAP');

        exit();
    }

    public function generateJsonResponse($data)
    {
        $output = json_encode($data, JSON_UNESCAPED_UNICODE);

        header('Content-Type: application/json; charset=utf-8');
        header('Content-Length: ' . strlen($output));

        echo $output;

        exit();
    }

    public function generateSmevEnvelope($name, $data)
    {
        $content = $this->prepareSmevTemplate($name, $data);

        $cp = new CryptoPro();

        return $cp->signXML($content, 0);
    }

    private function prepareTemplate($data, $cert, $tpl)
    {
        $tpl_name = $tpl ? $tpl : 'response';
        require_once __DIR__ . '/../templates/_soap/'.$tpl_name.'.php';

        return $content;
    }

    private function prepareSmevTemplate($name, $data)
    {
        //здесь я передаю данные прямо в шаблон.
        require_once __DIR__ . '/../templates/_smev/' . $name . '.php';

        return $content;
    }

}