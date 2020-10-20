<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model\Data;

use Casio\PhysicalStore\Api\Data\PhysicalStoreInterface;

class PhysicalStore extends \Magento\Framework\Api\AbstractExtensibleObject implements PhysicalStoreInterface
{

    /**
     * Get physicalstore_id
     * @return string|null
     */
    public function getPhysicalstoreId()
    {
        return $this->_get(self::PHYSICALSTORE_ID);
    }

    /**
     * Set physicalstore_id
     * @param string $physicalstoreId
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setPhysicalstoreId($physicalstoreId)
    {
        return $this->setData(self::PHYSICALSTORE_ID, $physicalstoreId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Casio\PhysicalStore\Api\Data\PhysicalStoreExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get code
     * @return string|null
     */
    public function getCode()
    {
        return $this->_get(self::CODE);
    }

    /**
     * Set code
     * @param string $code
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Get opening_time
     * @return string|null
     */
    public function getOpeningTime()
    {
        return $this->_get(self::OPENING_TIME);
    }

    /**
     * Set opening_time
     * @param string $openingTime
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setOpeningTime($openingTime)
    {
        return $this->setData(self::OPENING_TIME, $openingTime);
    }

    /**
     * Get phone_number
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->_get(self::PHONE_NUMBER);
    }

    /**
     * Set phone_number
     * @param string $phoneNumber
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setPhoneNumber($phoneNumber)
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * Get regular_holiday
     * @return string|null
     */
    public function getRegularHoliday()
    {
        return $this->_get(self::REGULAR_HOLIDAY);
    }

    /**
     * Set regular_holiday
     * @param string $regularHoliday
     * @return \Casio\PhysicalStore\Api\Data\PhysicalStoreInterface
     */
    public function setRegularHoliday($regularHoliday)
    {
        return $this->setData(self::REGULAR_HOLIDAY, $regularHoliday);
    }
}

