<?php


namespace App;

use SoapClient;
use Ramsey\Uuid\Uuid;

class Smev
{

    public function ack($request_data)
    {

        $data = json_decode(utf8_encode($request_data), true, 512, JSON_UNESCAPED_UNICODE);

        $envelope = App::$parser->generateSmevEnvelope('ack',  $data['messageId']);

        $result = $this->sendToSmev(App::$config->get('smev'), $envelope, 'urn:Ack');

        $parser = new ParseXMLResponse();

        App::$parser->generateJsonResponse($parser->parseSendRequestRequestResponse($result));
    }

    public function inn_request($request_data)
    {

        $data = json_decode(utf8_encode($request_data), true, 512, JSON_UNESCAPED_UNICODE);

        $data['legal_entity']['ogrn'] = isset($data['legal_entity']['ogrn']) ? $data['legal_entity']['ogrn'] : 'ogrn';
        $data['legal_entity']['inn'] = isset($data['legal_entity']['inn']) ? $data['legal_entity']['inn'] : 'inn';
        $data['legal_entity']['name'] = isset($data['legal_entity']['name']) ? $data['legal_entity']['name'] : 'name' ;

        $data['individual']['birthDay'] = isset($data['individual']['birthDay']) ? $data['individual']['birthDay'] : 'birthDay';
        $data['individual']['birthPlace'] = isset($data['individual']['birthPlace']) ? $data['individual']['birthPlace'] : 'birthPlace';

        $data['individual']['firstName'] = isset($data['individual']['firstName']) ? $data['individual']['firstName'] : 'firstName';
        $data['individual']['lastName'] = isset($data['individual']['lastName']) ? $data['individual']['lastName'] : 'lastName';
        $data['individual']['secondName'] = isset($data['individual']['secondName']) ? $data['individual']['secondName'] : 'secondName';

        $data['individual']['document']['docCode'] = isset($data['individual']['document']['docCode']) ? $data['individual']['document']['docCode'] : 'docCode';
        $data['individual']['document']['number'] = isset($data['individual']['document']['number']) ? $data['individual']['document']['number'] : 'number';
        $data['individual']['document']['date'] = isset($data['individual']['document']['date']) ? $data['individual']['document']['date'] : 'date';
        $data['individual']['document']['issueName'] = isset($data['individual']['document']['issueName']) ? $data['individual']['document']['issueName'] : 'issueName';
        $data['individual']['document']['issueCode'] = isset($data['individual']['document']['issueCode']) ? $data['individual']['document']['issueCode'] : 'issueCode';

        $data['MessageID'] = Uuid::uuid1()->toString();

        $envelope = App::$parser->generateSmevEnvelope('inn_request', $data);

        $result = $this->sendToSmev(App::$config->get('smev'), $envelope, 'urn:SendRequest');

        $parser = new ParseXMLResponse();

        App::$parser->generateJsonResponse($parser->parseSendRequestRequestResponse($result));

    }

    public function snils_request($request_data)
    {
        $data = json_decode(utf8_encode($request_data), true, 512, JSON_UNESCAPED_UNICODE);

        $data['lastName'] = isset($data['lastName']) ? $data['lastName'] : 'lastName';
        $data['firstName'] = isset($data['firstName']) ? $data['firstName'] : 'firstName';
        $data['secondName'] = isset($data['secondName']) ? $data['secondName'] : 'secondName';
        $data['gender'] = isset($data['gender']) ? $data['gender'] : 'gender';
        $data['birthDay'] = isset($data['birthDay']) ? $data['birthDay'] : 'birthDay';

        $data['MessageID'] = Uuid::uuid1()->toString();

        $envelope = App::$parser->generateSmevEnvelope('snils_request', $data);

        $result = $this->sendToSmev(App::$config->get('smev'), $envelope, 'urn:SendRequest');

        $parser = new ParseXMLResponse();

        App::$parser->generateJsonResponse($parser->parseSendRequestRequestResponse($result));

    }

    public function inn_response()
    {

        $envelope = App::$parser->generateSmevEnvelope('inn_response', null);

        $result = $this->sendToSmev(App::$config->get('smev'), $envelope, 'urn:GetResponse');

        $parser = new ParseXMLResponse();

        App::$parser->generateJsonResponse($parser->parseGetRequestResponseResponse($result, 'inn'));

    }

    public function snils_response()
    {

        $envelope = App::$parser->generateSmevEnvelope('snils_response', null);

        $result = $this->sendToSmev(App::$config->get('smev'), $envelope, 'urn:GetResponse');

        $parser = new ParseXMLResponse();

        App::$parser->generateJsonResponse($parser->parseGetRequestResponseResponse($result, 'snils'));

    }

    private function sendToSmev($host, $envelope, $urn)
    {

        try {
            $client = new SoapClient($host.'?wsdl', ['trace' => true, 'connection_timeout' => 3]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        try {
            $result = $client->__doRequest($envelope, $host.'?wsdl', $urn, '1');
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

        return $result;
    }

}