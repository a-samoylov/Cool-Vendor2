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
        \ASI\SomeAPI\Model\APIProcess\APIProcessFactory $processFactory,
        \ASI\SomeAPI\Model\Definition\APIConfigFactory $configFactory

        /*\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \ASI\SomeAPI\Model\BearerTokensFactory $bearerTokensFactory*/
        )
	{
        $this->_pageFactory     = $pageFactory;
        $this->_authFactory     = $authFactory;
        $this->_processFactory  = $processFactory;
        $this->_configFactory   = $configFactory;
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
            array (
                'bearer_token' => $package->get('bearer_token')
            )
        );
        if(!$auth->isUserAuthorized()) {
            //error
            echo json_encode(array("error" => "Invalid bearer token"));
            return;
        }




        try {
            $apiProcess = $this->_processFactory->create(
                array(
                    'version' => $package->get('version'),
                    'command' => $package->get('command'),
                    'params'  => $package->get('params')
                )
            );

            echo json_encode($apiProcess->startProcessing());
        } catch (\Exception $exception) {
            echo json_encode(array("error" => $exception->getMessage()));
            return;
        }
	}
}