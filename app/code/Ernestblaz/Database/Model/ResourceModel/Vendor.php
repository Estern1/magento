<?php


namespace Ernestblaz\Database\Model\ResourceModel;


class Vendor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('vendor_entity', 'vendor_id');
    }
}
