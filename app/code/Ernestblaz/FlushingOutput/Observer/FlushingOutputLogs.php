<?php
namespace Ernestblaz\FlushingOutput\Observer;

use Magento\Framework\Event\ObserverInterface;

class FlushingOutputLogs implements ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->info('Flushing output log. ' . $observer->getData('response'));
    }
}
