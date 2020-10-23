<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ShopRepositoryInterface
{
    /**
     * Retrieve Shop
     * @param string $shop_code
     * @return \Casio\Shop\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByCode($shop_code);

    /**
     * Retrieve Shop matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Casio\Shop\Api\Data\ShopSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
}

