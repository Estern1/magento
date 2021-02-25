<?php

namespace Ernestblaz\API\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Ernestblaz\Database\Model\VendorFactory;

class RemoveVendor implements ResolverInterface
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

        $vendorId = ((int) $args['vendor_id']) ?: null;
        $vendor->load($vendorId);

        if (!$vendor->getVendorId()) {
            throw new GraphQlInputException(__('The vendor was not found.'));
        }

        $vendor->delete();

        return [
            'success' => true
        ];
    }
}
