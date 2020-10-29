<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Api\Data;

interface ShopSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Shop list.
     * @return \Casio\Shop\Api\Data\ShopInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Casio\Shop\Api\Data\ShopInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

