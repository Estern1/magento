<?php

namespace Ernestblaz\API\Model\Resolver;

use Ernestblaz\Database\Model\VendorFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AddVendor implements ResolverInterface
{
    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    public function __construct(
        VendorFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $vendor = $this->vendorFactory->create();
        $vendor->setVendorName($args['input']['vendor_name'])
            ->setVendorCode($args['input']['vendor_code'])
            ->setVendorType($args['input']['vendor_type']);
        $vendor->save();

        $vendor->load($vendor->getVendorId());
        $result = [
            'vendor_id' => $vendor->getVendorId(),
            'vendor_name' => $vendor->getVendorName(),
            'vendor_code' => $vendor->getVendorCode(),
            'upgrade_date' => $vendor->getUpgradeDate(),
            'vendor_type' => $vendor->getVendorType(),
        ];

        return [
            'vendor' => $result
        ];
    }
}
