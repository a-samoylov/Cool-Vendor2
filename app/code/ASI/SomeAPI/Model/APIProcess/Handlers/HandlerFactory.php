<?php
namespace ASI\SomeAPI\Model\APIProcess\Handlers;

class HandlerFactory {
    protected $_namespaceHandler = 'ASI\SomeAPI\Model\APIProcess\Handlers\\';
    protected $_objectManager = null;
    protected $_instanceName = null;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
        )
    {
        $this->_objectManager = $objectManager;
    }

    public function create(array $data = array())
    {
        $this->_instanceName = $this->_namespaceHandler . $data['handlerName'];
        return $this->_objectManager->create($this->_instanceName, []);
    }
    /*private $namespace_handler = 'ASI\SomeAPI\Model\APIProcess\Handlers\\';

    public function __construct() {

    }

    public function create($handler_name) {
        $handler_class_name = $this->namespace_handler . $handler_name;
        $handler = new $handler_class_name();

        if(!($handler instanceof HandlerInterface)) {
            throw new \Exception("Invalid type handler!");
        }

        return $handler;
    }*/
}