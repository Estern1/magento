<?php

namespace Ernestblaz\API\Model\Resolver;

use Ernestblaz\Database\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\StoreManagerInterface;

class VendorItem implements ResolverInterface
{
    /**
     * @var CollectionFactory
     */
    private $vendorFactory;

    public function __construct(
        CollectionFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $collection = $this->vendorFactory->create();

        $result = [];
        foreach ($collection as $vendor) {
            $result[] = [
                'vendor_id' => $vendor->getVendorId(),
                'vendor_name' => $vendor->getVendorName(),
                'vendor_code' => $vendor->getVendorCode(),
                'upgrade_date' => $vendor->getUpgradeDate(),
                'vendor_type' => $vendor->getVendorType(),
            ];
        }

        return $result;
    }
}
