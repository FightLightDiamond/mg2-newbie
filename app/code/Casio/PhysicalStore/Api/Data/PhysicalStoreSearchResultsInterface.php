<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Api\Data;

interface PhysicalStoreSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get PhysicalStore list.
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

