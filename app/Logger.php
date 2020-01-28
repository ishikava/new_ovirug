<?php


namespace App;


class Logger
{

    public function log($type, $code)
    {

        switch ($type) {
            case 'access':
                if(App::$config->get('log_access')) $this->write('access', $code);
                break;
            case 'error':
                if(App::$config->get('log_error')) $this->write('error', $code);
                break;
            case 'debug':
                if(App::$config->get('log_debug')) $this->write('debug', $code);
                break;
            case 'unauthorized':
                if(App::$config->get('log_unauthorized')) $this->write('unauthorized', $code);
                break;
        }

    }

    private function write($fname, $code)
    {

        $msg = $_SERVER['REMOTE_ADDR'] . ' - - [' . date('d/m/Y:H:i:s') . ' +3 UTC] ' . $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . ' "' . $code . '"' . PHP_EOL;

        file_put_contents('../log/' . $fname . '.log', $msg, FILE_APPEND);

    }

}