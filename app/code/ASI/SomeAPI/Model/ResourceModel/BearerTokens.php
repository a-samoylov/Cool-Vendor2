<?php

namespace ASI\SomeAPI\Model\ResourceModel;

class BearerTokens extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('bearer_tokens', 'bearer_token_id');
    }

}
