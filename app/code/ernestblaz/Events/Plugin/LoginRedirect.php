<?php

namespace ernestblaz\Events\Plugin;

use Magento\Framework\Event\ManagerInterface as EventManager;

class LoginRedirect
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

    public function afterExecute(\Magento\Customer\Controller\Account\CreatePost $subject, $result)
    {
        return $this->eventManager->dispatch('register_event');
    }
}
