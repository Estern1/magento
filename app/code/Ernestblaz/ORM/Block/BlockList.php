<?php

namespace Ernestblaz\ORM\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Store\Model\ResourceModel\Store\CollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterfaceFactory;

class BlockList extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CollectionFactory
     */
    private $_storeCollectionFactory;
    /**
     * @var CategoryRepositoryInterfaceFactory
     */
    private $_categoryRepositoryFactory;

    public function __construct(
        Context $context,
        CollectionFactory $storeCollectionFactory,
        CategoryRepositoryInterfaceFactory $categoryRepositoryFactory,
        array $data = []
    ) {
        $this->_storeCollectionFactory = $storeCollectionFactory;
        $this->_categoryRepositoryFactory = $categoryRepositoryFactory;
        parent::__construct($context, $data);
    }

    public function getStoreCollection()
    {
        return $this->_storeCollectionFactory->create();
    }

    public function getCategoryById($categoryId)
    {
        return $this->_categoryRepositoryFactory->create()->get($categoryId);
    }
}
