<?php
namespace Ernestblaz\Events\Observer;

use Magento\Framework\App\ResponseFactory;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\UrlInterface;

class RedirectAfterRegister implements ObserverInterface
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var UrlInterface
     */
    private $url;

    public function __construct(
        ResponseFactory $responseFactory,
        UrlInterface $url
    ) {
        $this->responseFactory = $responseFactory;
        $this->url = $url;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $redirectionUrl = $this->url->getUrl('customer/account/login');
        $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();

        return $this;
    }
}
