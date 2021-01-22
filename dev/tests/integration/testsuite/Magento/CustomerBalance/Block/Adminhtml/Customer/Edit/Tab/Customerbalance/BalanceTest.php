<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CustomerBalance\Block\Adminhtml\Customer\Edit\Tab\Customerbalance;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * Test customer balance block in admin.
 *
 * @see \Magento\CustomerBalance\Block\Adminhtml\Customer\Edit\Tab\Customerbalance\Balance
 *
 * @magentoAppArea adminhtml
 */
class BalanceTest extends TestCase
{
    /** @var ObjectManagerInterface */
    private $objectManager;

    /** @var Page */
    private $page;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManager = Bootstrap::getObjectManager();
        $this->page = $this->objectManager->get(PageFactory::class)->create();
    }

    /**
     * @return void
     */
    public function testBalanceLabel(): void
    {
        $this->preparePage();
        $block = $this->page->getLayout()->getBlock('customerbalance.balance');
        $this->assertNotFalse($block);
        $this->assertStringContainsString((string)__('Store Credit Balance'), strip_tags($block->toHtml()));
    }

    /**
     * Prepare page before render
     *
     * @return void
     */
    private function preparePage(): void
    {
        $this->page->addHandle([
            'default',
            'customer_index_edit',
        ]);
        $this->page->getLayout()->generateXml();
    }
}
