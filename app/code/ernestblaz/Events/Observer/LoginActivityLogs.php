<?php
namespace ernestblaz\Events\Observer;

use DateTime;
use Magento\Framework\Event\ObserverInterface;

class LoginActivityLogs implements ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->info('Activity log. Customer id: ' . $observer->getData('id') . ' Date: ' . date_format(new DateTime(), 'H:i:s d-m-Y'));
    }
}
