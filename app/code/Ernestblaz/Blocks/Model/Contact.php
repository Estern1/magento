<?php

namespace Ernestblaz\Blocks\Model;

class Contact extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Ernestblaz\Blocks\Model\ResourceModel\Contact::class);
    }
}
