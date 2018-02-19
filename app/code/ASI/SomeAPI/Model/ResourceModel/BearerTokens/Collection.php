<?php
namespace ASI\SomeAPI\Model\ResourceModel\BearerTokens;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'bearer_token_id';
	protected $_eventPrefix = 'bearer_tokens_collection';
	protected $_eventObject = 'bearertoken_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('ASI\SomeAPI\Model\BearerTokens', 'ASI\SomeAPI\Model\ResourceModel\BearerTokens');
	}

}