<?php
namespace Ernestblaz\RoutingAndControllers\Controller\Test;

class Forward extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_redirect('/');
    }
}
