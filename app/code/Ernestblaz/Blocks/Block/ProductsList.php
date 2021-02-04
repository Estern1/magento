<?php

namespace Ernestblaz\Blocks\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Api\Data\ProductInterface;

class ProductsList extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Api\SearchCriteriaInterface
     */
    private $searchCriteria;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterfaceFactory
     */
    private $_productRepositoryFactory;
    /**
     * @var \Magento\Framework\Api\Search\FilterGroup
     */
    private $filterGroup;

    public function __construct(
        Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterfaceFactory $productRepositoryFactory,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        array $data = []
    ) {
        $this->_productRepositoryFactory = $productRepositoryFactory;
        $this->searchCriteria = $criteria;
        $this->filterGroup = $filterGroup;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $this->filterGroup->setFilters([
            $this->filterBuilder
                ->setField(ProductInterface::NAME)
                ->setConditionType('like')
                ->setValue('%')
                ->create(),
        ]);

        $this->searchCriteria->setFilterGroups([$this->filterGroup]);
        $this->searchCriteria->setPageSize(15);
        $products = $this->_productRepositoryFactory->create()->getList($this->searchCriteria);

        return $products->getItems();
    }
}
