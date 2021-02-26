<?php

namespace Ernestblaz\API\Model\Resolver;

use Ernestblaz\Database\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Vendors implements ResolverInterface
{
    /**
     * @var CollectionFactory
     */
    private $vendorCollectionFactory;

    public function __construct(
        CollectionFactory $vendorCollectionFactory
    ) {
        $this->vendorCollectionFactory = $vendorCollectionFactory;
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
        if (!isset($args['search']) || !isset($args['filter'])) {
            throw new GraphQlInputException(
                __("'search' and 'filter' input argument is required.")
            );
        }

        $vendorCollection = $this->vendorCollectionFactory->create();

        $vendors = [];
        foreach ($vendorCollection as $vendor) {
            if (strpos($vendor->getVendorName(), $args['search']) === false &&
                strpos($vendor->getVendorCode(), $args['search']) === false) {
                continue;
            }

            if (!$this->filter($args['filter'], $vendor)) {
                continue;
            }

            $vendors[] = [
                'vendor_id' => $vendor->getVendorId(),
                'vendor_name' => $vendor->getVendorName(),
                'vendor_code' => $vendor->getVendorCode(),
                'upgrade_date' => $vendor->getUpgradeDate(),
                'vendor_type' => $vendor->getVendorType(),
            ];
        }

        return [
            'items_count' => count($vendors),
            'items' => $vendors
        ];
    }

    private function filter($filter, $vendor): bool
    {
        foreach ($filter as $propertyName => $propertyValue) {
            foreach ($propertyValue as $key => $value) {
                if ($key == 'in') {
                    if (!in_array($vendor->{'get' . $propertyName}(), $value)) {
                        return false;
                    }
                } elseif ($key == 'eq') {
                    if ($vendor->{'get' . $propertyName}() != $value) {
                        return false;
                    }
                } elseif ($key == 'match') {
                    if ($vendor->{'get' . $propertyName}() != $value) {
                        return false;
                    }
                } elseif ($key == 'from') {
                    if ($vendor->{'get' . $propertyName}() < $value) {
                        return false;
                    }
                } elseif ($key == 'to') {
                    if ($vendor->{'get' . $propertyName}() > $value) {
                        return false;
                    }
                }
            }
        }

        return true;
    }
}
