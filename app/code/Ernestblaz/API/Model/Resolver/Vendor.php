<?php

namespace Ernestblaz\API\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Vendor implements ResolverInterface
{
    /**
     * @var ValueFactory
     */
    private $valueFactory;

    /**
     * @param ValueFactory $valueFactory
     */
    public function __construct(
        ValueFactory $valueFactory
    ) {
        $this->valueFactory = $valueFactory;
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
        $vendor = ['vendor_id' => '1',
            'vendor_name' => 'name',
            'vendor_code' => 'code',
            'upgrade_date' => 'date',
            'vendor_type' => '2'];

        $result = function () use ($vendor) {
            return !empty($vendor) ? $vendor : [];
        };

        return $this->valueFactory->create($result);
    }
}
