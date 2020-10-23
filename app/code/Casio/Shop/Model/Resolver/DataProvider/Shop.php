<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model\Resolver\DataProvider;

use Casio\Shop\Api\ShopRepositoryInterface;

class Shop
{
    /**
     * @var ShopRepositoryInterface
     */
    private $repository;

    /**
     * Shop constructor.
     * @param ShopRepositoryInterface $repository
     */
    public function __construct(ShopRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $shop_code
     * @return \Casio\Shop\Api\Data\ShopInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getShop($shop_code)
    {
        return $this->repository->getByCode($shop_code)->toArray();
    }
}

