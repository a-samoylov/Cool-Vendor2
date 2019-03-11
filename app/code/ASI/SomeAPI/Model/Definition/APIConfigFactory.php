<?php

namespace ASI\SomeAPI\Model\Definition;

class APIConfigFactory
{
    protected $_objectManager = null;
    protected $_instanceName  = '\\ASI\\SomeAPI\\Model\\Definition\\APIConfig';
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_objectManager = $objectManager;
        $this->_scopeConfig   = $scopeConfig;
    }

    public function create(array $data = [])
    {
        $configs_api      = $this->_scopeConfig->getValue('API', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $handler_name     = '';
        $validators_names = [];
        $properties_names = [];

        //Get config api from xml
        foreach ($configs_api as $api) {
            foreach ($api as $key_api_element => $api_element) {
                if ($key_api_element == 'version' && $api_element == $data['version']) {
                    foreach ($api['list_commands'] as $key_api_command => $api_command) {
                        if ($api_command['name'] == $data['command']) {
                            $handler_name     = $api_command['handler'];
                            $validators_names = $api_command['validators'];
                            $properties_names = $api_command['properties'];
                        }
                    }
                }
            }
        }

        if ($handler_name == '') {
            ;
            throw new \Exception('Command not found');
        }

        if ($properties_names == null) {
            $properties_names = [];
        }

        if ($validators_names == null) {
            $validators_names = [];
        }

        return $this->_objectManager->create(
            $this->_instanceName,
            [
                'handler_name'     => $handler_name,
                'validators_names' => $validators_names,
                'params'           => $properties_names
            ]
        );
    }
}
