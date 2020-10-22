<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model;

use Casio\Shop\Api\Data\ShopInterfaceFactory;
use Casio\Shop\Api\Data\ShopSearchResultsInterfaceFactory;
use Casio\Shop\Api\ShopRepositoryInterface;
use Casio\Shop\Model\ResourceModel\Shop as ResourceShop;
use Casio\Shop\Model\ResourceModel\Shop\CollectionFactory as ShopCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class ShopRepository implements ShopRepositoryInterface
{

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $resource;

    protected $shopCollectionFactory;

    protected $dataShopFactory;

    protected $shopFactory;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    private $storeManager;


    /**
     * @param ResourceShop $resource
     * @param ShopFactory $shopFactory
     * @param ShopInterfaceFactory $dataShopFactory
     * @param ShopCollectionFactory $shopCollectionFactory
     * @param ShopSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceShop $resource,
        ShopFactory $shopFactory,
        ShopInterfaceFactory $dataShopFactory,
        ShopCollectionFactory $shopCollectionFactory,
        ShopSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->shopFactory = $shopFactory;
        $this->shopCollectionFactory = $shopCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataShopFactory = $dataShopFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Casio\Shop\Api\Data\ShopInterface $shop)
    {
        /* if (empty($shop->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $shop->setStoreId($storeId);
        } */

        $shopData = $this->extensibleDataObjectConverter->toNestedArray(
            $shop,
            [],
            \Casio\Shop\Api\Data\ShopInterface::class
        );

        $shopModel = $this->shopFactory->create()->setData($shopData);

        try {
            $this->resource->save($shopModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the shop: %1',
                $exception->getMessage()
            ));
        }
        return $shopModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($shopId)
    {
        $shop = $this->shopFactory->create();
        $this->resource->load($shop, $shopId);
        if (!$shop->getId()) {
            throw new NoSuchEntityException(__('Shop with id "%1" does not exist.', $shopId));
        }
        //todo: not working api GraphQL
       /* return $shop->getDataModel();*/
        return $shop->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($code)
    {
        $shop = $this->shopCollectionFactory->create();

        $shop->addAttributeToFilter('shop_code', $code)->getFirstItem();

//        $this->resource->load($shop, $shopId);
        if (!$shop->getId()) {
            throw new NoSuchEntityException(__('Shop with code "%1" does not exist.', $code));
        }
        //todo: not working api GraphQL
       /* return $shop->getDataModel();*/
        return $shop->toArray();
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

        //todo: not working with graphQL
/*        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);*/
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Casio\Shop\Api\Data\ShopInterface $shop)
    {
        try {
            $shopModel = $this->shopFactory->create();
            $this->resource->load($shopModel, $shop->getShopId());
            $this->resource->delete($shopModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Shop: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($shopId)
    {
        return $this->delete($this->get($shopId));
    }
}

