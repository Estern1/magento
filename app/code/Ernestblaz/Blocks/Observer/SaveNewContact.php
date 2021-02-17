<?php

namespace Ernestblaz\Blocks\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveNewContact implements ObserverInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->objectManager = $objectManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $contact = $this->objectManager->create(\Ernestblaz\Blocks\Model\Contact::class);
        $contact->setName($observer->getData('contact')['name'])
            ->setEmail($observer->getData('contact')['email'])
            ->setTelephone($observer->getData('contact')['telephone'])
            ->setComment($observer->getData('contact')['comment'])
            ->setCountry($observer->getData('contact')['country']);
        $contact->save();
    }
}
