<?php

namespace Ernestblaz\Database\Model;

class Vendor extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Ernestblaz\Database\Model\ResourceModel\Vendor::class);
    }
}
