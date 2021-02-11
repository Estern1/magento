<?php

namespace Ernestblaz\AdminPanel\Controller\Adminhtml\Vendor;

class Save extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        $vendor = $this->_objectManager->create(\Ernestblaz\Database\Model\Vendor::class);
        $vendor->setVendorName($params['vendor_name'])->setVendorCode($params['vendor_code']);
        $vendor->save();

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/post', ['_current' => true]);
    }
}
