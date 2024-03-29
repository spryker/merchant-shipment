<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\MerchantShipment\Business\Facade;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\ItemBuilder;
use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group MerchantShipment
 * @group Business
 * @group Facade
 * @group ExpandCartChangeShipmentWithMerchantReferenceTest
 * Add your own group annotations below this line
 */
class ExpandCartChangeShipmentWithMerchantReferenceTest extends Unit
{
    /**
     * @var string
     */
    protected const TEST_MERCHANT_REFERENCE1 = 'merchant-reference-1';

    /**
     * @var string
     */
    protected const TEST_MERCHANT_REFERENCE2 = 'merchant-reference-2';

    /**
     * @var \SprykerTest\Zed\MerchantShipment\MerchantShipmentBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testExpandCartChangeShipmentWithMerchantReferenceExpandsItemShipmentWithMerchantReference(): void
    {
        // Arrange
        $cartChangeTransfer = (new CartChangeTransfer())
            ->addItem((new ItemBuilder([ItemTransfer::MERCHANT_REFERENCE => static::TEST_MERCHANT_REFERENCE1]))->withShipment()->build())
            ->addItem((new ItemBuilder([ItemTransfer::MERCHANT_REFERENCE => static::TEST_MERCHANT_REFERENCE2]))->withShipment()->build());

        // Act
        $expandedCartChangeTransfer = $this->tester
            ->getFacade()
            ->expandCartChangeShipmentWithMerchantReference($cartChangeTransfer);

        // Assert
        $this->assertSame(
            $cartChangeTransfer->getItems()->offsetGet(0)->getMerchantReference(),
            $expandedCartChangeTransfer->getItems()->offsetGet(0)->getShipment()->getMerchantReference(),
        );
        $this->assertSame(
            $cartChangeTransfer->getItems()->offsetGet(1)->getMerchantReference(),
            $expandedCartChangeTransfer->getItems()->offsetGet(1)->getShipment()->getMerchantReference(),
        );
    }

    /**
     * @return void
     */
    public function testExpandCartChangeShipmentWithMerchantReferenceExpandsItemShipmentWithoutShipment(): void
    {
        // Arrange
        $cartChangeTransfer = (new CartChangeTransfer())
            ->addItem((new ItemBuilder([ItemTransfer::MERCHANT_REFERENCE => static::TEST_MERCHANT_REFERENCE1]))->build())
            ->addItem((new ItemBuilder([ItemTransfer::MERCHANT_REFERENCE => static::TEST_MERCHANT_REFERENCE2]))->withShipment()->build());

        // Act
        $expandedCartChangeTransfer = $this->tester
            ->getFacade()
            ->expandCartChangeShipmentWithMerchantReference($cartChangeTransfer);

        // Assert
        $this->assertNull($expandedCartChangeTransfer->getItems()->offsetGet(0)->getShipment());
        $this->assertSame(
            $cartChangeTransfer->getItems()->offsetGet(1)->getMerchantReference(),
            $expandedCartChangeTransfer->getItems()->offsetGet(1)->getShipment()->getMerchantReference(),
        );
    }
}
