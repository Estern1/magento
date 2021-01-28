<?php


namespace Ernestblaz\FlushingOutput\Plugin;
use Magento\Framework\Event\ManagerInterface as EventManager;

class Http
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

    public function afterLaunch(\Magento\Framework\App\Http $subject, $result)
    {
        $this->eventManager->dispatch('flushing_output', ['response' => $result->getContent()]);
        return $result;
    }
}
