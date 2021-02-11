<?php

namespace Ernestblaz\AdminPanel\Controller\Adminhtml\Vendor;

use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
