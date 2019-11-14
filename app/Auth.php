<?php


namespace App;


class Auth
{

    public function isAuth($route_auth)
    {

        if (App::$config->get('auth') && $route_auth) {

            return $this->getBearerToken() === $this->getHash() ? true : false;

        }

        return true;

    }

    public function login($requested_data)
    {

        $data = json_decode($requested_data, true);

        if (!$data) {

            App::$log->log('error', 'Invalid JSON');
            App::$parser->generateJsonResponse([
                'Message' => 'Invalid JSON'
            ]);

        }

        if (isset($data['email']) && isset($data['password']) && $data['email'] == App::$config->get('email') && $data['password'] == App::$config->get('password')) {

            App::$log->log('access', '200 OK JSON');
            App::$parser->generateJsonResponse([
                'token' => $this->getHash()
            ]);

        } else {

            App::$log->log('error', 'Login failed JSON');
            App::$parser->generateJsonResponse([
                'Message' => 'Login failed'
            ]);

        }

    }

    private function getHash()
    {
        return md5(md5(App::$config->get('email')) . md5(App::$config->get('password')) . md5(date('d')));
    }

    private function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else {
            if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)),
                    array_values($requestHeaders));
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
        }
        return $headers;
    }

    private function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

}