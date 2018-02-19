<?php
namespace ASI\SomeAPI\Model\APIProcess\Validators;

interface ValidatorInterface
{
    //bool return true if params suitable
    public function validate($params);
}