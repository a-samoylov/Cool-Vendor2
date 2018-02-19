<?php
namespace ASI\SomeAPI\Model\APIProcess;

//require_once 'Handlers/HandlerFactory.php';
//require_once 'Validators/ValidatorFactory.php';

use ASI\SomeAPI\Model\APIProcess\Handlers\HandlerFactory;
use ASI\SomeAPI\Model\APIProcess\Validators\ValidatorFactory;

class APIProcess {
    private $handler_name;
    private $validators_names = [];
    private $params;

    public function __construct($handler_name, $validators_names, $params) {
        $this->params           = $params;
        $this->handler_name     = $handler_name;
        $this->validators_names = $validators_names;
    }

    //return array or if exeption false
    public function startProcessing() {
        foreach ($this->validators_names as $key => $validatorsName) {
            $validator = (new ValidatorFactory())->create($validatorsName);
            if(!$validator->validate($this->params)) {
                //error validate
                throw new \Exception('Invalid params');
            }
        }

        exit;
        //create handler
        $handler = (new HandlerFactory())->create($this->handler_name);
        return $handler->run($this->params);
    }
}