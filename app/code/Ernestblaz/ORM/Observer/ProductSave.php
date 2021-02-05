<?php

namespace Ernestblaz\ORM\Observer;

use Magento\Framework\Event\ObserverInterface;

class ProductSave implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();
        $compareArray = ['name','short_description','price','special_price','cost','weight','special_from_date','special_to_date','status','visibility','is_salable'];

        $log = 'Product save operation log. Product id: ' . $observer->getData('product')->getData('entity_id');

        foreach ($compareArray as $value) {
            $old = $product->getOrigData($value);
            $new = $product->getData($value);

            if ($old !== $new) {
                $log .= ', ' . $value . ': ' . $old . ' => ' . $new;
            }
        }

        $this->logger->info($log);
    }
}
