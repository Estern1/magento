<?php
namespace Ernestblaz\API\Model;

class VendorManagement
{
    /**
     * @var \Ernestblaz\Database\Model\VendorFactory
     */
    private $vendorFactory;

    public function __construct(
        \Ernestblaz\Database\Model\VendorFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
    }

    public function getVendor($id)
    {
        $vendor = $this->vendorFactory->create();

        $vendor->load($id);

        return $vendor;
    }

    public function getVendorsList()
    {
        $vendorFactory = $this->vendorFactory->create();
        $collection = $vendorFactory->getCollection();

        $result = [];
        foreach ($collection as $vendor) {
            $result[] = $vendor;
        }

        return $result;
    }

    public function addVendor($vendor_name, $vendor_code, $vendor_type)
    {
        $vendor = $this->vendorFactory->create();
        $vendor->setVendorName($vendor_name)
            ->setVendorCode($vendor_code)
            ->setVendorType($vendor_type);
        $vendor->save();

        $return = new \Ernestblaz\API\Model\ReturnSuccess();
        $return->setSuccess(true);
        return $return;
    }

    public function modifyVendor($id, $vendor_name, $vendor_code, $vendor_type)
    {
        $vendor = $this->vendorFactory->create();

        $vendor->load($id);

        if (!$vendor->getVendorId()) {
            $return = new \Ernestblaz\API\Model\ReturnSuccess();
            $return->setSuccess(false);
            return $return;
        }

        $vendor->setVendorName($vendor_name)
            ->setVendorCode($vendor_code)
            ->setVendorType($vendor_type);

        $vendor->save();

        $return = new \Ernestblaz\API\Model\ReturnSuccess();
        $return->setSuccess(true);
        return $return;
    }

    public function removeVendor($id)
    {
        $vendor = $this->vendorFactory->create();

        $vendor->load($id);

        if (!$vendor->getVendorId()) {
            $return = new \Ernestblaz\API\Model\ReturnSuccess();
            $return->setSuccess(false);
            return $return;
        }

        $vendor->delete();

        $return = new \Ernestblaz\API\Model\ReturnSuccess();
        $return->setSuccess(true);
        return $return;
    }
}
