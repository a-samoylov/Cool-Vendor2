<?php

namespace ASI\SomeAPI\Model\APIProcess\Handlers;

class HandlerFactory
{
    protected $_namespaceHandler = 'ASI\SomeAPI\Model\APIProcess\Handlers\\';
    protected $_objectManager    = null;
    protected $_instanceName     = null;

    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    public function create(array $data = [])
    {
        $this->_instanceName = $this->_namespaceHandler . $data['handlerName'];

        return $this->_objectManager->create($this->_instanceName, []);
    }
}
