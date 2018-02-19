<?php
namespace ASI\SomeAPI\Controller\Format1;

use Magento\TestFramework\Event\Magento;
use ASI\SomeAPI\Model\Package\PackageFormat1Factory;
use ASI\SomeAPI\Model\APIProcess\APIProcessFactory;
use ASI\SomeAPI\Model\Test\Test;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
    protected $_authFactory;

	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \ASI\SomeAPI\Model\Auth\AuthFactory $authFactory
        /*\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \ASI\SomeAPI\Model\BearerTokensFactory $bearerTokensFactory*/
        )
	{
        $this->_pageFactory = $pageFactory;
        $this->_authFactory = $authFactory;

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

        $auth = $this->_authFactory->create(
            ['bearer_token' => $package->get('bearer_token')]
        );
        if(!$auth->isUserAuthorized()) {
            //error
            echo json_encode(array("error" => "Invalid bearer token"));
            return;
        }

        //$value = $this->_scopeConfig->getValue('API', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        //var_dump($value);

        /*try {
            $apiProcess = (new APIProcessFactory())
                ->create(
                    $this->_scopeConfig,
                    $package->get('version'),
                    $package->get('command'),
                    $package->get('params')
                );

            echo json_encode($apiProcess->startProcessing());
        } catch (\Exception $exception) {
            echo json_encode(array("error" => $exception->getMessage()));
            return;
        }*/
	}
}