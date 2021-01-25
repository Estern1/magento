<?php

namespace ernestblaz\Interceptors\Plugin;


class ProductName
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '[' . $result . ']';
    }
}
