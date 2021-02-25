<?php

namespace Ernestblaz\API\Model\Resolver;

use Ernestblaz\Database\Model\VendorFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Ernestblaz\Database\Model\ResourceModel\Vendor as VendorResources;

class Vendors implements ResolverInterface
{
    /**
     * @var VendorFactory
     */
    private $vendorFactory;
    /**
     * @var VendorResources
     */
    private $vendorResource;

    public function __construct(
        VendorResources $vendorResource,
        VendorFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
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
        $vendor = $this->vendorFactory->create();
        $this->vendorResource->load($vendor, 'vendor_id');

        return [
            'items_count' => $vendor->getCollection()->count(),
            'model' => $vendor,
        ];
    }
}
