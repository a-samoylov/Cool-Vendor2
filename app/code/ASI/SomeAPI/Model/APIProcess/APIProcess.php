<?php
namespace ASI\SomeAPI\Model\APIProcess;

use ASI\SomeAPI\Model\APIProcess\Validators\ValidatorFactory;

class APIProcess {
    private $handler_name;
    private $validators_names = [];
    private $params;
    private $handlerFactory;

    public function __construct(
        $handler_name,
        $validators_names,
        $params,
        \ASI\SomeAPI\Model\APIProcess\Handlers\HandlerFactory $handlerFactory
        )
    {
        $this->params           = $params;
        $this->handler_name     = $handler_name;
        $this->validators_names = $validators_names;
        $this->handlerFactory   = $handlerFactory;
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

        //create handler
        $handler = $this->handlerFactory->create(
            array(
                'handlerName' => $this->handler_name
            )
        );
        return $handler->run($this->params);
    }
}