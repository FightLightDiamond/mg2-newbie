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
     * Save Shop
     * @param \Casio\Shop\Api\Data\ShopInterface $shop
     * @return \Casio\Shop\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Casio\Shop\Api\Data\ShopInterface $shop);

    /**
     * Retrieve Shop
     * @param string $shopId
     * @return \Casio\Shop\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($shopId);

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

    /**
     * Delete Shop
     * @param \Casio\Shop\Api\Data\ShopInterface $shop
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Casio\Shop\Api\Data\ShopInterface $shop);

    /**
     * Delete Shop by ID
     * @param string $shopId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($shopId);
}

