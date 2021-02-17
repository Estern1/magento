<?php


namespace Ernestblaz\Blocks\Model\ResourceModel;


class Contact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('contact', 'id');
    }
}
