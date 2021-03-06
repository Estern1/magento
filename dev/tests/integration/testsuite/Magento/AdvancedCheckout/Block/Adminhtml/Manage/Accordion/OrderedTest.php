<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AdvancedCheckout\Block\Adminhtml\Manage\Accordion;

/**
 * Checks ordered items grid appearance
 *
 * @magentoAppArea adminhtml
 * @magentoDbIsolation enabled
 */
class OrderedTest extends AbstractManageTest
{
    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->block = $this->layout->createBlock(Ordered::class);
    }

    /**
     * @magentoDataFixture Magento/Sales/_files/order_with_customer.php
     *
     * @return void
     */
    public function testGetItemsCollection(): void
    {
        $this->prepareRegistry('customer@example.com', 'default');
        $this->assertCollectionItem(['simple'], $this->block->getItemsCollection());
    }
}
