<?php
namespace ASI\SomeAPI\Model\Auth;

class Auth {
    private $bearer_token;
    private $bearer_tokens_factory;

    public function __construct(
        $bearer_token,
        \ASI\SomeAPI\Model\BearerTokensFactory $bearer_tokens_factory
        )
    {
        $this->bearer_token = $bearer_token;
        $this->bearer_tokens_factory = $bearer_tokens_factory;
    }

    public function isUserAuthorized() {
        $token_collection = $this->bearer_tokens_factory->create()->getCollection();

        foreach($token_collection as $item){
            if($item->getData()['value'] == $this->bearer_token) {
                return true;
            }
        }

        return false;
    }
}