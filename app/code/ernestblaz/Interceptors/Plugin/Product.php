<?php

namespace ernestblaz\Interceptors\Plugin;


class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '[' . $result . ']';
    }
}
