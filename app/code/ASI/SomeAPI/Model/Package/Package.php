<?php
namespace ASI\SomeAPI\Model\Package;

class Package {
    private $store = [];

    public function __construct($bearer_token, $version, $command, $params) {
        $this->store['bearer_token'] = $bearer_token;
        $this->store['version']      = $version;
        $this->store['command']      = $command;
        $this->store['params']       = $params;
    }

    public function set($key, $value){
        $this->store[$key] = $value;
    }

    public function get($key){
        return $this->store[$key];
    }
}