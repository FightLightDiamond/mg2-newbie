<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model\Resolver\DataProvider;


use Casio\Shop\Api\ShopRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;

class Shops
{
    private $repository;

    private $searchCriteriaBuilder;

    public function __construct(ShopRepositoryInterface $repository, SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param $args
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getShops($args)
    {
        $searchCriteria = $this->searchCriteriaBuilder->build('Shop', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->repository->getList($searchCriteria);

        return [
            'total_count' => $searchResult->getTotalCount(),
            'items' => $searchResult->getItems(),
        ];
    }
}

