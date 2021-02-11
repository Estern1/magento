<?php


namespace Ernestblaz\AdminPanel\Block\Adminhtml;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * GenericButton constructor.
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []) : string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
