<?php

namespace Ernestblaz\Router\Controller\Demo;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class Demo extends \Magento\Framework\App\Action\Action
{
    protected $_request;

    /**
     * Demo constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        echo('Success');
        exit();
    }
}
