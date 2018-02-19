<?php
namespace ASI\SomeAPI\Model\Definition;

use ASI\SomeAPI\Model\Definition\APIConfig;

class APIConfigFactory {

    public function __construct() {

    }

    public function create(
        \Magento\Framework\App\Config\ScopeConfigInterface $scope_config,
        $version,
        $command
        )
    {
        $configs_api = $scope_config->getValue('API', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $handler_name = '';
        $validators_names = [];
        $properties_names = [];

        //Get config api from xml
        foreach ($configs_api as $api) {
            foreach ($api as $key_api_element => $api_element) {
                if($key_api_element == 'version' && $api_element == $version) {
                    foreach ($api['list_commands'] as $key_api_command => $api_command) {
                        if($api_command['name'] == $command) {
                            $handler_name       = $api_command['handler'];
                            $validators_names   = $api_command['validators'];
                            $properties_names   = $api_command['properties'];
                        }
                    }
                }
            }
        }

        if($handler_name == '') {;
            throw new \Exception('Command not found');
        }

        if($properties_names == null){
            $properties_names = [];
        }

        if($validators_names == null){
            $validators_names = [];
        }

        return new APIConfig(
            $handler_name,
            $validators_names,
            $properties_names
        );
    }
}