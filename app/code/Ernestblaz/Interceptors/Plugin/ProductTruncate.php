<?php

namespace Ernestblaz\Interceptors\Plugin;


use _HumbugBoxe8a38a0636f4\Nette\Neon\Exception;
use Magento\Framework\Exception\NoSuchEntityException;
use function PHPUnit\Framework\throwException;

class ProductTruncate
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function aroundGetName(\Magento\Catalog\Model\Product $subject, callable $proceed)
    {
        $result = $proceed();

        try {
            if ($this->_storeManager->getStore()->getCode() == 'UK') {
                $result = substr($result, 0, 15);
            }
        } catch (NoSuchEntityException $e) {
            throwException($e);
        }

        return $result;
    }
}
