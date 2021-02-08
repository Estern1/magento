<?php


namespace Ernestblaz\Database\Model\ResourceModel\Vendor;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Ernestblaz\Database\Model\Vendor::class, \Ernestblaz\Database\Model\ResourceModel\Vendor::class);
    }
}
