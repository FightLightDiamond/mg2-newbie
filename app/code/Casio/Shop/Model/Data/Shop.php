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
     * Get shop_name
     * @return string|null
     */
    public function getShopName()
    {
        return $this->_get(self::SHOP_NAME);
    }

    /**
     * Set shop_name
     * @param string $shopName
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopName($shopName)
    {
        return $this->setData(self::SHOP_NAME, $shopName);
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
     * Get shop_code
     * @return string|null
     */
    public function getShopCode()
    {
        return $this->_get(self::SHOP_CODE);
    }

    /**
     * Set shop_code
     * @param string $shopCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopCode($shopCode)
    {
        return $this->setData(self::SHOP_CODE, $shopCode);
    }

    /**
     * Get shop_tel
     * @return string|null
     */
    public function getShopTel()
    {
        return $this->_get(self::SHOP_TEL);
    }

    /**
     * Set shop_tel
     * @param string $shopTel
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopTel($shopTel)
    {
        return $this->setData(self::SHOP_TEL, $shopTel);
    }

    /**
     * Get shop_business_hours
     * @return string|null
     */
    public function getShopBusinessHours()
    {
        return $this->_get(self::SHOP_BUSINESS_HOURS);
    }

    /**
     * Set shop_business_hours
     * @param string $shopBusinessHours
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopBusinessHours($shopBusinessHours)
    {
        return $this->setData(self::SHOP_BUSINESS_HOURS, $shopBusinessHours);
    }

    /**
     * Get shop_holidays
     * @return string|null
     */
    public function getShopHolidays()
    {
        return $this->_get(self::SHOP_HOLIDAYS);
    }

    /**
     * Set shop_holidays
     * @param string $shopHolidays
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopHolidays($shopHolidays)
    {
        return $this->setData(self::SHOP_HOLIDAYS, $shopHolidays);
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

