<?php


namespace Ernestblaz\EAV\Model\Config\Source;


class GpuArchitectureOptions extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('Lovelace'), 'value' => '0'],
            ['label' => __('Ampere'), 'value' => '1'],
            ['label' => __('oneAPI'), 'value' => '2']
        ];

        return $this->_options;

    }
}
