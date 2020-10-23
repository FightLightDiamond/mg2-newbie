<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Shop implements ResolverInterface
{

    private $shopDataProvider;

    /**
     * @param DataProvider\Shop $shopRepository
     */
    public function __construct(DataProvider\Shop $shopDataProvider)
    {
        $this->shopDataProvider = $shopDataProvider;
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
    ) {
        return $this->shopDataProvider->getShop($args['shop_code']);
    }
}

