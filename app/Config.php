<?php


namespace App;


class Config
{
    private $config;

    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . '/../config.ini', true);
    }

    /**
     * @return array|bool
     */
    public function get($name)
    {
        return isset($this->config[$name]) ? $this->config[$name] : false;
    }

}