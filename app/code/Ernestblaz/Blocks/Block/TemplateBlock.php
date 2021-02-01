<?php


namespace Ernestblaz\Blocks\Block;


class TemplateBlock extends \Magento\Framework\View\Element\Template
{
    protected function _beforeToHtml()
    {
        $this->prepareBlockData();
        return parent::_beforeToHtml();
    }

    protected function prepareBlockData()
    {
        $this->addData(
            [
                'description' => 'Opis testowy'
            ]
        );
    }
}
