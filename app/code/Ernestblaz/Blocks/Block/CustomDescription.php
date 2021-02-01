<?php

namespace Ernestblaz\Blocks\Block;

class CustomDescription extends \Magento\Framework\View\Element\AbstractBlock
{
    protected function _beforeToHtml()
    {
        $this->prepareBlockData();
        return parent::_beforeToHtml();
    }

    protected function prepareBlockData()
    {
//        $this->addData(
//            [
//                'description' => 'Opis testowy'
//            ]
//        );
    }
}
