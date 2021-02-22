<?php


namespace Ernestblaz\API\Api\Data;


interface VendorManagementInterface
{
    /**
     * @return string
     **/
    public function getVendorName();

    /**
     * @return string
     **/
    public function getVendorCode();

    /**
     * @return integer
     **/
    public function getVendorType();

    /**
     * @return string
     **/
    public function getUpgradeDate();
}
