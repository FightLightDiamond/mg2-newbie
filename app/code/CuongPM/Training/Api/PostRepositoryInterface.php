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
     * @param PostInterface $store
     */
    public function save(PostInterface $store): void;

    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return SearchResultsInterface
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
