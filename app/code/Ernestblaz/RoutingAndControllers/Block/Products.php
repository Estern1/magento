<?php
namespace Ernestblaz\RoutingAndControllers\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Products extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
//        $collection->addAttributeToSelect('*');
        $collection->setPageSize(10);

        $result = $collection->toArray();
        return json_encode($result);
    }
}
