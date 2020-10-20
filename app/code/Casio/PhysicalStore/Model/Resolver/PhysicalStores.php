<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model\Resolver;

use Casio\PhysicalStore\Api\PhysicalStoreRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class PhysicalStores implements ResolverInterface
{
    private $postRepository;

    private $searchCriteriaBuilder;

    public function __construct(PhysicalStoreRepositoryInterface $postRepository, SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param array $args
     * @throws GraphQlInputException
     */
    private function validateArgs(array $args): void
    {
        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }
        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $this->validateArgs($args);

        $searchCriteria = $this->searchCriteriaBuilder->build('PhysicalStore', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->postRepository->getList($searchCriteria);

        $data = [
            'total_count' => $searchResult->getTotalCount(),
            'items' => $searchResult->getItems(),
        ];

        return $data;
    }
}
