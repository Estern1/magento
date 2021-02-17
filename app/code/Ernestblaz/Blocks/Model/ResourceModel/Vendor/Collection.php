<?php

namespace Ernestblaz\Blocks\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'vendor_id';

    protected function _construct()
    {
        $this->_init(\Ernestblaz\Blocks\Model\Contact::class, \Ernestblaz\Blocks\Model\ResourceModel\Contact::class);
    }
}
