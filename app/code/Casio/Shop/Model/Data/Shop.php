<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Model\Data;

use Casio\Shop\Api\Data\ShopInterface;

class Shop extends \Magento\Framework\Api\AbstractExtensibleObject implements ShopInterface
{

    /**
     * Get shop_id
     * @return string|null
     */
    public function getShopId()
    {
        return $this->_get(self::SHOP_ID);
    }

    /**
     * Set shop_id
     * @param string $shopId
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopId($shopId)
    {
        return $this->setData(self::SHOP_ID, $shopId);
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
     * @param string $shopName
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setName($shopName)
    {
        return $this->setData(self::NAME, $shopName);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Casio\Shop\Api\Data\ShopExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Casio\Shop\Api\Data\ShopExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Casio\Shop\Api\Data\ShopExtensionInterface $extensionAttributes
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
     * @param string $shopCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setCode($shopCode)
    {
        return $this->setData(self::CODE, $shopCode);
    }

    /**
     * Get tel
     * @return string|null
     */
    public function getTel()
    {
        return $this->_get(self::TEL);
    }

    /**
     * Set tel
     * @param string $shopTel
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setTel($shopTel)
    {
        return $this->setData(self::TEL, $shopTel);
    }

    /**
     * Get business_hours
     * @return string|null
     */
    public function getBusinessHours()
    {
        return $this->_get(self::BUSINESS_HOURS);
    }

    /**
     * Set business_hours
     * @param string $shopBusinessHours
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setBusinessHours($shopBusinessHours)
    {
        return $this->setData(self::BUSINESS_HOURS, $shopBusinessHours);
    }

    /**
     * Get holidays
     * @return string|null
     */
    public function getHolidays()
    {
        return $this->_get(self::HOLIDAYS);
    }

    /**
     * Set holidays
     * @param string $shopHolidays
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setHolidays($shopHolidays)
    {
        return $this->setData(self::HOLIDAYS, $shopHolidays);
    }

    /**
     * Get source_code
     * @return string|null
     */
    public function getSourceCode()
    {
        return $this->_get(self::SOURCE_CODE);
    }

    /**
     * Set source_code
     * @param string $sourceCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setSourceCode($sourceCode)
    {
        return $this->setData(self::SOURCE_CODE, $sourceCode);
    }
}

