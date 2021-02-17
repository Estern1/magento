<?php

namespace Ernestblaz\Blocks\Plugin;

use Magento\Framework\Event\ManagerInterface as EventManager;

class Post
{
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        EventManager $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    public function afterExecute(\Magento\Contact\Controller\Index\Post $subject, $result)
    {
        $this->eventManager->dispatch('after_contact_event', ['contact' => $subject->getRequest()->getParams()]);
        return $result;
    }
}
