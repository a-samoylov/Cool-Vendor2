<?php
namespace ASI\SomeAPI\Controller\Format2;

use Magento\TestFramework\Event\Magento;
use ASI\SomeAPI\Model\Package\PackageFormat2Factory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_authFactory;
    protected $_processFactory;
    protected $_configFactory;
    protected $_dataFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \ASI\SomeAPI\Model\Auth\AuthFactory $authFactory,
        \ASI\SomeAPI\Model\APIProcess\APIProcessFactory $processFactory,
        \ASI\SomeAPI\Helper\DataFactory $dataFactory
        )
    {
        $this->_pageFactory     = $pageFactory;
        $this->_authFactory     = $authFactory;
        $this->_processFactory  = $processFactory;
        $this->_dataFactory     = $dataFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        try {
            $dataPOST = trim(file_get_contents('php://input'));

            $package = (new PackageFormat2Factory)->create(
                (new \Zend_Controller_Request_Http())->getHeader('someapi_bearer_token'),
                $dataPOST
            );
        } catch (\Exception $exception) {
            echo $this->_dataFactory->create()->arrayToXml(array("error" => $exception->getMessage()));
            return;
        }

        $auth = $this->_authFactory->create([
            'bearer_token' => $package->get('bearer_token')
        ]);
        if(!$auth->isUserAuthorized()) {
            //error
            echo $this->_dataFactory->create()->arrayToXml(array("error" => "Invalid bearer token"));
            return;
        }

        try {
            $apiProcess = $this->_processFactory->create([
                'version' => $package->get('version'),
                'command' => $package->get('command'),
                'params'  => $package->get('params')
            ]);
            echo $this->_dataFactory->create()->arrayToXml($apiProcess->startProcessing());
        } catch (\Exception $exception) {
            echo $this->_dataFactory->create()->arrayToXml(array("error" => $exception->getMessage()));
            return;
        }
    }
}