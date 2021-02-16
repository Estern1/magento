<?php

namespace Ernestblaz\AdminPanel\Controller\Adminhtml\Vendor;

use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Backend\App\Action
{
    protected $helperData;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ernestblaz\AdminPanel\Helper\Data $helperData
    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Ernestblaz_AdminPanel::post');
        if (!$this->helperData->getGeneralConfig('isenabled')) {
            $resultPage->getConfig()->getTitle()->prepend('Vendor Post Form is not available');
        }

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
