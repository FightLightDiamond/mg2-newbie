<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model;

use Casio\Shop\Api\Data\ShopSearchResultsInterfaceFactory;
use Casio\Shop\Api\ShopRepositoryInterface;
use Casio\Shop\Model\ResourceModel\Shop as ResourceShop;
use Casio\Shop\Model\ResourceModel\Shop\CollectionFactory as ShopCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class ShopRepository implements ShopRepositoryInterface
{
    private $collectionProcessor;

    protected $resource;

    protected $shopCollectionFactory;

    protected $dataShopFactory;

    protected $shopFactory;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectHelper;

    protected $searchResultsFactory;

    /**
     * @param ResourceShop $resource
     * @param ShopFactory $shopFactory
     * @param ShopCollectionFactory $shopCollectionFactory
     * @param ShopSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        ResourceShop $resource,
        ShopFactory $shopFactory,
        ShopCollectionFactory $shopCollectionFactory,
        ShopSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->resource = $resource;
        $this->shopFactory = $shopFactory;
        $this->shopCollectionFactory = $shopCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($code)
    {
        $shop = $this->shopFactory->create();
        $this->resource->load($shop, $code, 'code');

        if (!$shop->getId()) {
            throw new NoSuchEntityException(__('Shop with code "%1" does not exist.', $code));
        }

        return $shop;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->shopCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Casio\Shop\Api\Data\ShopInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
