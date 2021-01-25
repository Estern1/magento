<?php

namespace ernestblaz\ProductPrice\Model\Rewrite\Catalog;


class Product extends \Magento\Catalog\Model\Product
{
    /**
     * Get product price through type instance
     *
     * @return float
     */
    public function getPrice(): float
    {
        if ($this->_calculatePrice || !$this->getData(self::PRICE)) {
            return $this->getPriceModel()->getPrice($this) * 1.1;
        } else {
            return $this->getData(self::PRICE) * 1.1;
        }
    }
}
