<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Api\Data;

interface PhysicalStoreInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const PHONE_NUMBER = 'phone_number';
    const OPENING_TIME = 'opening_time';
    const PHYSICALSTORE_ID = 'physicalstore_id';
    const REGULAR_HOLIDAY = 'regular_holiday';
    const CODE = 'code';

    /**
     * Get physicalstore_id
     * @return string|null
     */
    public function getPhysicalstoreId();

    /**
     * Set physicalstore_id
     * @param string $physicalstoreId
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setPhysicalstoreId($physicalstoreId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface $extensionAttributes
    );

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setCode($code);

    /**
     * Get opening_time
     * @return string|null
     */
    public function getOpeningTime();

    /**
     * Set opening_time
     * @param string $openingTime
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setOpeningTime($openingTime);

    /**
     * Get phone_number
     * @return string|null
     */
    public function getPhoneNumber();

    /**
     * Set phone_number
     * @param string $phoneNumber
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get regular_holiday
     * @return string|null
     */
    public function getRegularHoliday();

    /**
     * Set regular_holiday
     * @param string $regularHoliday
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setRegularHoliday($regularHoliday);
}

