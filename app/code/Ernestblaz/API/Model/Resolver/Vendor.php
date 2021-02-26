<?php

namespace Ernestblaz\API\Model\Resolver;

use Ernestblaz\Database\Model\VendorFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Vendor implements ResolverInterface
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
        $vendor->load($args['vendor_id']);
        return $vendor;
    }
}
