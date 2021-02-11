<?php

namespace Ernestblaz\AdminPanel\Model;

use Ernestblaz\Database\Model\ResourceModel\Vendor\Collection;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    private $loadedData;
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Collection $vendorCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $vendorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $vendorCollectionFactory->load();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $response) {
            $this->loadedData[$response->getVendorId()] = $response->getData();
        }

        return $this->loadedData;
    }
}
