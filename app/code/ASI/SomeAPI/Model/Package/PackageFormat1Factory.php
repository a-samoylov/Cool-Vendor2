<?php
namespace ASI\SomeAPI\Model\Package;

require_once 'Package.php';

class PackageFormat1Factory {

    public function __construct() {

    }

    public function create($bearer_token, $paramsPackage) {
        if(!$bearer_token) {
            throw new \Exception('Invalid bearer token');
        }

        if(!array_key_exists ('version', $paramsPackage) || $paramsPackage['version'] == '') {
            throw new \Exception('Invalid version');
        }

        if(!array_key_exists ('command', $paramsPackage) || $paramsPackage['command'] == '') {
            throw new \Exception('Invalid command');
        }

        if(!array_key_exists ('params', $paramsPackage)) {
            $params = new \stdClass();
        } else {
            $params = json_decode($paramsPackage['params']);
        }

        return new Package(
            $bearer_token,
            $paramsPackage['version'],
            $paramsPackage['command'],
            $params
        );
    }
    
}