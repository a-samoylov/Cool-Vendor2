<?php
namespace ASI\SomeAPI\Model\APIProcess\Handlers;

class HandlerFactory {
    private $namespace_handler = 'ASI\SomeAPI\Model\APIProcess\Handlers\\';

    public function __construct() {

    }

    public function create($handler_name) {
        $handler_class_name = $this->namespace_handler . $handler_name;
        $handler = new $handler_class_name();

        if(!($handler instanceof HandlerInterface)) {
            throw new \Exception("Invalid type handler!");
        }

        return $handler;
    }
}