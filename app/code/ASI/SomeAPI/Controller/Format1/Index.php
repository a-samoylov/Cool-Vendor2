<?php
namespace ASI\SomeAPI\Controller\Format1;

require_once(__DIR__ . "/../../Model/Package/PackageFormat1Factory.php");

use Magento\TestFramework\Event\Magento;
use ASI\SomeAPI\Model\Package\PackageFormat1Factory;

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
        try {
            $input_params = $this->getRequest()->getParams();
            $package = (new PackageFormat1Factory)->create(
                '123',//$this->getRequest()->getHeader('someapi_bearer_token'),
                $input_params
            );
        } catch (\Exception $exception) {
            echo json_encode(array("error" => $exception->getMessage()));
            return;
        }
        

        /*$post = $this->_bearerTokensFactory->create();
        $collection = $post->getCollection();
        foreach($collection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }*/
	}
}