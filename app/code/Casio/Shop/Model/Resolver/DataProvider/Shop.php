<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model\Resolver\DataProvider;

use Casio\Shop\Api\ShopRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;

class Shop
{
    private $repository;

    private $searchCriteriaBuilder;

    public function __construct(ShopRepositoryInterface $repository, SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getShop($shop_code)
    {
        return $this->repository->getByCode($shop_code);
    }
}

