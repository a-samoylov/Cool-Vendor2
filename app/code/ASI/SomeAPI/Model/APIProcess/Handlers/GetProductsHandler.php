<?php
namespace ASI\SomeAPI\Model\APIProcess\Handlers;

require_once 'HandlerInterface.php';

class GetProductsHandler implements HandlerInterface {

    public function __construct() {

    }

    public function run($params) {
        $products = \Mage::getModel('catalog/product')->getCollection()
            ->setPage(0, $params->limit)
            ->setOrder('entity_id', $params->sort);

        return $products->getData();
    }
}