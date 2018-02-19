<?php
namespace ASI\SomeAPI\Model;
class BearerTokens extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'bearer_tokens';

	protected $_cacheTag = 'bearer_tokens';

	protected $_eventPrefix = 'bearer_tokens';

	protected function _construct()
	{
		$this->_init('ASI\SomeAPI\Model\ResourceModel\BearerTokens');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}