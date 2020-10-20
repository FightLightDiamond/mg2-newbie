<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PhysicalStoreRepositoryInterface
{

    /**
     * Save PhysicalStore
     * @param \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
    );

    /**
     * Retrieve PhysicalStore
     * @param string $physicalstoreId
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($physicalstoreId);

    /**
     * Retrieve PhysicalStore matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete PhysicalStore
     * @param \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
    );

    /**
     * Delete PhysicalStore by ID
     * @param string $physicalstoreId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($physicalstoreId);
}

