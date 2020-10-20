<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model;

use Casio\PhysicalStore\Api\Data\PhysicalStoreInterfaceFactory;
use Casio\PhysicalStore\Api\Data\PhysicalStoreSearchResultsInterfaceFactory;
use Casio\PhysicalStore\Api\PhysicalStoreRepositoryInterface;
use Casio\PhysicalStore\Model\ResourceModel\PhysicalStore as ResourcePhysicalStore;
use Casio\PhysicalStore\Model\ResourceModel\PhysicalStore\CollectionFactory as PhysicalStoreCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class PhysicalStoreRepository implements PhysicalStoreRepositoryInterface
{
    private $collectionProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    private $storeManager;

    protected $dataPhysicalStoreFactory;

    protected $physicalStoreFactory;

    protected $physicalStoreCollectionFactory;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectHelper;

    /**
     * @param ResourcePhysicalStore $resource
     * @param PhysicalStoreFactory $physicalStoreFactory
     * @param PhysicalStoreInterfaceFactory $dataPhysicalStoreFactory
     * @param PhysicalStoreCollectionFactory $physicalStoreCollectionFactory
     * @param PhysicalStoreSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePhysicalStore $resource,
        PhysicalStoreFactory $physicalStoreFactory,
        PhysicalStoreInterfaceFactory $dataPhysicalStoreFactory,
        PhysicalStoreCollectionFactory $physicalStoreCollectionFactory,
        PhysicalStoreSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->physicalStoreFactory = $physicalStoreFactory;
        $this->physicalStoreCollectionFactory = $physicalStoreCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPhysicalStoreFactory = $dataPhysicalStoreFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
    ) {
        /* if (empty($physicalStore->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $physicalStore->setStoreId($storeId);
        } */

        $physicalStoreData = $this->extensibleDataObjectConverter->toNestedArray(
            $physicalStore,
            [],
            \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface::class
        );

        $physicalStoreModel = $this->physicalStoreFactory->create()->setData($physicalStoreData);

        try {
            $this->resource->save($physicalStoreModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the physicalStore: %1',
                $exception->getMessage()
            ));
        }
        return $physicalStoreModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($physicalStoreId)
    {
        $physicalStore = $this->physicalStoreFactory->create();
        $this->resource->load($physicalStore, $physicalStoreId);
        if (!$physicalStore->getId()) {
            throw new NoSuchEntityException(__('PhysicalStore with id "%1" does not exist.', $physicalStoreId));
        }
        return $physicalStore->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->physicalStoreCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $id = $model->getPhysicalstoreId();
            $name = $model->getName();
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface $physicalStore
    ) {
        try {
            $physicalStoreModel = $this->physicalStoreFactory->create();
            $this->resource->load($physicalStoreModel, $physicalStore->getPhysicalstoreId());
            $this->resource->delete($physicalStoreModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the PhysicalStore: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($physicalStoreId)
    {
        return $this->delete($this->get($physicalStoreId));
    }
}
