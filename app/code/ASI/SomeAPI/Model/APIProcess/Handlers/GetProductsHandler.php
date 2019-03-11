<?php

namespace ASI\SomeAPI\Model\APIProcess\Handlers;

class GetProductsHandler implements HandlerInterface
{
    private $collectionFactory;

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function run($params)
    {
        $collection = $this->collectionFactory->create()
                                              ->addAttributeToSelect('*')
                                              ->addAttributeToSort('entity_id', $params->sort)
                                              ->setPageSize($params->limit);

        return $collection->getData();
    }
}
