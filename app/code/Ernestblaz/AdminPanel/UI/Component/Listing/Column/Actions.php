<?php

namespace Ernestblaz\AdminPanel\UI\Component\Listing\Column;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'remove' => [
                        'href' => $this->storeManager->getStore()->getUrl('adminpanel/vendor/remove', ['id' => $item['vendor_id']]),
                        'label' => __('Remove')
                    ],
                ];
            }
        }

        return $dataSource;
    }
}
