<?php


namespace Ernestblaz\API\Api;


interface VendorManagementInterface
{
    /**
     * @param integer $id
     * @return Data\VendorManagementInterface
     */
    public function getVendor($id);

    /**
     * @return Data\VendorManagementInterface[]
     */
    public function getVendorsList();

    /**
     * @param string $vendor_name
     * @param string $vendor_code
     * @param integer $vendor_type
     * @return Data\ReturnSuccessInterface
     */
    public function addVendor($vendor_name, $vendor_code, $vendor_type);

    /**
     * @param integer $id
     * @param string $vendor_name
     * @param string $vendor_code
     * @param integer $vendor_type
     * @return Data\ReturnSuccessInterface
     */
    public function modifyVendor($id, $vendor_name, $vendor_code, $vendor_type);

    /**
     * @param integer $id
     * @return Data\ReturnSuccessInterface
     */
    public function removeVendor($id);
}
