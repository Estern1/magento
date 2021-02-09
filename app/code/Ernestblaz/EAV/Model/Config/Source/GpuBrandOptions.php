<?php


namespace Ernestblaz\EAV\Model\Config\Source;


class GpuBrandOptions extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('AMD'), 'value' => '0'],
            ['label' => __('Intel'), 'value' => '1']
        ];

        return $this->_options;

    }
}
