<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model;

use Casio\Shop\Api\Data\ShopInterface;
use Casio\Shop\Api\Data\ShopInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Shop extends \Magento\Framework\Model\AbstractModel
{
    protected $shopDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'casio_shop';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ShopInterfaceFactory $shopDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Casio\Shop\Model\ResourceModel\Shop $resource
     * @param \Casio\Shop\Model\ResourceModel\Shop\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ShopInterfaceFactory $shopDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Casio\Shop\Model\ResourceModel\Shop $resource,
        \Casio\Shop\Model\ResourceModel\Shop\Collection $resourceCollection,
        array $data = []
    ) {
        $this->shopDataFactory = $shopDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve shop model with shop data
     * @return ShopInterface
     */
    public function getDataModel()
    {
        $shopData = $this->getData();

        $shopDataObject = $this->shopDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $shopDataObject,
            $shopData,
            ShopInterface::class
        );

        return $shopDataObject;
    }
}
