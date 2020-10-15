<?php

namespace CuongPM\Training\Api;

use CuongPM\Training\Api\Data\PostInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * Save the Store data.
     *
     * @param \Magento\InventoryApi\Api\Data\SourceInterface $source
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(PostInterface $store): void;

    /**
     * Find Stores by given SearchCriteria
     * SearchCriteria is not required because load all stores is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface;

    /**
     * @param $id
     * @param $name
     * @param $status
     * @param $content
     * @return array
     */
    public function update($id, $name, $status, $content);
}
