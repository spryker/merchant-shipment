<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantShipment\Communication\Plugin\Cart;

use Generated\Shared\Transfer\CartChangeTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\ItemExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\MerchantShipment\Communication\MerchantShipmentCommunicationFactory getFactory()
 */
class MerchantShipmentItemExpanderPlugin extends AbstractPlugin implements ItemExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expects `cartChange.items.shipment` to be set.
     * - Expands `cartChange.items.shipment` transfer object with merchant reference.
     * - Uses `merchantReference` from `cartChange.items`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer
    {
        return $this->getFactory()
            ->createShipmentExpander()
            ->expandCartChangeShipmentWithMerchantReference($cartChangeTransfer);
    }
}
