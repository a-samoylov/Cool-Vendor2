<?php
namespace ASI\SomeAPI\Model\Package;

class PackageFormat2Factory {

    public function __construct() {

    }

    public function create($bearer_token, $paramsPackage) {
        $paramsPackage = json_decode($paramsPackage);

        if(!$bearer_token) {
            throw new \Exception('Invalid bearer token');
        }

        if($paramsPackage->version == '') {
            throw new \Exception('Invalid version');
        }

        if($paramsPackage->command == '') {
            throw new \Exception('Invalid command');
        }

        return new Package(
            $bearer_token,
            $paramsPackage->version,
            $paramsPackage->command,
            $paramsPackage->params
        );
    }
    
}