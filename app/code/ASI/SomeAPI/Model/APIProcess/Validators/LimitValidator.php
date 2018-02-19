<?php
namespace ASI\SomeAPI\Model\APIProcess\Validators;

require_once 'ValidatorInterface.php';

class LimitValidator implements ValidatorInterface {

    const LIMIT_MIN = 1;
    const LIMIT_MAX = 1000;

    public function __construct() {

    }

    public function validate($params)
    {
        if(isset($params->limit) &&
            $params->limit >= LimitValidator::LIMIT_MIN &&
            $params->limit <= LimitValidator::LIMIT_MAX){

            return true;
        }

        return false;
    }
}