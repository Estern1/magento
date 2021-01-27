<?php

namespace Ernestblaz\Events\Observer;

use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\AccountManagementInterface;

class ResetPassword implements ObserverInterface
{
    /**
     * @var \Magento\Customer\Api\AccountManagementInterface
     */
    protected $customerAccountManagement;

    public function __construct(
        AccountManagementInterface $customerAccountManagement
    ) {
        $this->customerAccountManagement = $customerAccountManagement;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->customerAccountManagement->initiatePasswordReset(
            $observer->getData('email'),
            AccountManagement::EMAIL_RESET
        );
    }
}
