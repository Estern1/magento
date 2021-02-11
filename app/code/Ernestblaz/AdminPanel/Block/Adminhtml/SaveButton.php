<?php


namespace Ernestblaz\AdminPanel\Block\Adminhtml;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData() : array
    {
        return [
            'label' => __('Save vendor'),
            'class' => 'save primary',
            'on_click' => '',
        ];
    }
}
