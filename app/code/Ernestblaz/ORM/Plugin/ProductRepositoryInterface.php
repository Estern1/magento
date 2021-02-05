<?php


namespace Ernestblaz\ORM\Plugin;


use Magento\Framework\Event\ManagerInterface as EventManager;

class ProductRepositoryInterface
{
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        EventManager $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    public function afterSave(\Magento\Catalog\Api\ProductRepositoryInterface $subject, $result)
    {
        $this->eventManager->dispatch('catalog_product_save_after', [$result]);
    }
}
