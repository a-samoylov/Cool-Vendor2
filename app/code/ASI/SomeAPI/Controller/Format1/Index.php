<?php
namespace ASI\SomeAPI\Controller\Format1;

use Magento\TestFramework\Event\Magento;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
    protected $_bearerTokensFactory;

	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \ASI\SomeAPI\Model\BearerTokensFactory $bearerTokensFactory
        )
	{
        $this->_pageFactory = $pageFactory;
        $this->_bearerTokensFactory = $bearerTokensFactory;
        return parent::__construct($context);
	}

	public function execute()
	{
        $post = $this->_bearerTokensFactory->create();
        $collection = $post->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        //exit();
        //return $this->_pageFactory->create();
	}
}