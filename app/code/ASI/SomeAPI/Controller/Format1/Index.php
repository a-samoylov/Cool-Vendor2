<?php
namespace ASI\SomeAPI\Controller\Format1;

use Magento\TestFramework\Event\Magento;
use ASI\SomeAPI\Model\Package\PackageFormat1Factory;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
    protected $_authFactory;
    protected $_processFactory;
    protected $_configFactory;

	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \ASI\SomeAPI\Model\Auth\AuthFactory $authFactory,
        \ASI\SomeAPI\Model\APIProcess\APIProcessFactory $processFactory
        )
	{
        $this->_pageFactory     = $pageFactory;
        $this->_authFactory     = $authFactory;
        $this->_processFactory  = $processFactory;
        return parent::__construct($context);
	}

	public function execute()
	{
        try {
            $input_params = $this->getRequest()->getParams();
            $package = (new PackageFormat1Factory)->create(
                '123',//(new \Zend_Controller_Request_Http())->getHeader('someapi_bearer_token'),
                $input_params
            );
        } catch (\Exception $exception) {
            echo json_encode(array("error" => $exception->getMessage()));
            return;
        }

        $auth = $this->_authFactory->create([
            'bearer_token' => $package->get('bearer_token')
        ]);
        if(!$auth->isUserAuthorized()) {
            //error
            echo json_encode(array("error" => "Invalid bearer token"));
            return;
        }

        try {
            $apiProcess = $this->_processFactory->create([
                'version' => $package->get('version'),
                'command' => $package->get('command'),
                'params'  => $package->get('params')

            ]);

            echo json_encode($apiProcess->startProcessing());
        } catch (\Exception $exception) {
            echo json_encode(array("error" => $exception->getMessage()));
            return;
        }
	}
}