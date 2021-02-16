<?php


namespace Ernestblaz\AdminPanel\Model\Config\Source;


class VendorTypeOptions extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('Guest'), 'value' => '1'],
            ['label' => __('User'), 'value' => '2'],
            ['label' => __('Developer'), 'value' => '3']
        ];

        return $this->_options;

    }
}
