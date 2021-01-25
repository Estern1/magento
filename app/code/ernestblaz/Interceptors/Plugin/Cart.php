<?php

namespace ernestblaz\Interceptors\Plugin;

class Cart
{
    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null)
    {
        if ($requestInfo['qty'] > 5) {
            $requestInfo['qty'] = 5;
        }

        return [$productInfo, $requestInfo];
    }
}
