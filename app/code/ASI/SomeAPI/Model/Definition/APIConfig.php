<?php

namespace ASI\SomeAPI\Model\Definition;

class APIConfig
{
    private $handler_name;
    private $validators_names;
    private $properties;

    public function __construct($handler_name, $validators_names, $params)
    {
        $this->handler_name     = $handler_name;
        $this->validators_names = $validators_names;
        $this->properties       = $params;
    }

    public function getHandler()
    {
        return $this->handler_name;
    }

    public function getValidators()
    {
        return $this->validators_names;
    }

    public function getProperties()
    {
        return $this->properties;
    }
}
