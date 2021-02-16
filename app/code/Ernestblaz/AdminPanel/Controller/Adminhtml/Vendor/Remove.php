<?php

namespace Ernestblaz\AdminPanel\Controller\Adminhtml\Vendor;

class Remove extends \Magento\Backend\App\Action
{
    private $logger;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $model = $this->_objectManager->create(\Ernestblaz\Database\Model\Vendor::class);

        try {
            $model->load($id);
            $model->delete();
            $this->messageManager->addSuccess(__('Vendor has been deleted !'));
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/manage', ['_current' => true]);
    }
}
