<?php

namespace ernestblaz\ProductName\Plugin;


class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '[' . $result . ']';
    }
}
