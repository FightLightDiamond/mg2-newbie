<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model;

use Casio\PhysicalStore\Api\Data\PhysicalStoreInterface;
use Casio\PhysicalStore\Api\Data\PhysicalStoreInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class PhysicalStore extends \Magento\Framework\Model\AbstractModel
{
    protected $_eventPrefix = 'casio_physicalstore_physicalstore';
    protected $dataObjectHelper;

    protected $physicalstoreDataFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PhysicalStoreInterfaceFactory $physicalstoreDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Casio\PhysicalStore\Model\ResourceModel\PhysicalStore $resource
     * @param \Casio\PhysicalStore\Model\ResourceModel\PhysicalStore\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PhysicalStoreInterfaceFactory $physicalstoreDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Casio\PhysicalStore\Model\ResourceModel\PhysicalStore $resource,
        \Casio\PhysicalStore\Model\ResourceModel\PhysicalStore\Collection $resourceCollection,
        array $data = []
    ) {
        $this->physicalstoreDataFactory = $physicalstoreDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve physicalstore model with physicalstore data
     * @return PhysicalStoreInterface
     */
    public function getDataModel()
    {
        $physicalstoreData = $this->getData();

        $physicalstoreDataObject = $this->physicalstoreDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $physicalstoreDataObject,
            $physicalstoreData,
            PhysicalStoreInterface::class
        );

        return $physicalstoreDataObject;
    }
}
