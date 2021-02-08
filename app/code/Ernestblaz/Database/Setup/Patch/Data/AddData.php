<?php

namespace Ernestblaz\Database\Setup\Patch\Data;

use Ernestblaz\Database\Model\ResourceModel\Vendor;
use Ernestblaz\Database\Model\VendorFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements \Magento\Framework\Setup\Patch\DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var Vendor
     */
    private $vendorResource;
    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Vendor $vendorResource,
        VendorFactory $vendorFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->vendorResource = $vendorResource;
        $this->vendorFactory = $vendorFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $vendorDTO = $this->vendorFactory->create();
        $vendorDTO->setVendorName('Ernestblaz')->setVendorCode('ernest@email.com');
        $this->vendorResource->save($vendorDTO);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
