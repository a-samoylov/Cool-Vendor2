<?php

namespace ASI\SomeAPI\Model\APIProcess;

class APIProcessFactory
{

    protected $_objectManager = null;
    protected $_instanceName  = '\\ASI\\SomeAPI\\Model\\APIProcess\\APIProcess';
    protected $_configFactory;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \ASI\SomeAPI\Model\Definition\APIConfigFactory $configFactory
    ) {
        $this->_objectManager = $objectManager;
        $this->_configFactory = $configFactory;
    }

    public function create(array $data = [])
    {
        $api_configs = $this->_configFactory->create(
            [
                'version' => $data['version'],
                'command' => $data['command']
            ]
        );

        $params = $data['params'];

        //merge params with properties in configs
        foreach ($api_configs->getProperties() as $key_property => $property) {
            if (!isset($params->$key_property)) {
                $params->$key_property = $property;
            }
        }

        return $this->_objectManager->create(
            $this->_instanceName,
            [
                'handler_name'     => $api_configs->getHandler(),
                'validators_names' => $api_configs->getValidators(),
                'params'           => $params
            ]
        );
    }
}
