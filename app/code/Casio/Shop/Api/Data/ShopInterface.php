<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\Shop\Api\Data;

interface ShopInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const SOURCE_CODE = 'source_code';
    const SHOP_TEL = 'shop_tel';
    const SHOP_NAME = 'shop_name';
    const SHOP_HOLIDAYS = 'shop_holidays';
    const SHOP_CODE = 'shop_code';
    const SHOP_BUSINESS_HOURS = 'shop_business_hours';
    const SHOP_ID = 'shop_id';

    /**
     * Get shop_id
     * @return string|null
     */
    public function getShopId();

    /**
     * Set shop_id
     * @param string $shopId
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopId($shopId);

    /**
     * Get shop_name
     * @return string|null
     */
    public function getShopName();

    /**
     * Set shop_name
     * @param string $shopName
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopName($shopName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Casio\Shop\Api\Data\ShopExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Casio\Shop\Api\Data\ShopExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Casio\Shop\Api\Data\ShopExtensionInterface $extensionAttributes
    );

    /**
     * Get shop_code
     * @return string|null
     */
    public function getShopCode();

    /**
     * Set shop_code
     * @param string $shopCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopCode($shopCode);

    /**
     * Get shop_tel
     * @return string|null
     */
    public function getShopTel();

    /**
     * Set shop_tel
     * @param string $shopTel
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopTel($shopTel);

    /**
     * Get shop_business_hours
     * @return string|null
     */
    public function getShopBusinessHours();

    /**
     * Set shop_business_hours
     * @param string $shopBusinessHours
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopBusinessHours($shopBusinessHours);

    /**
     * Get shop_holidays
     * @return string|null
     */
    public function getShopHolidays();

    /**
     * Set shop_holidays
     * @param string $shopHolidays
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setShopHolidays($shopHolidays);

    /**
     * Get source_code
     * @return string|null
     */
    public function getSourceCode();

    /**
     * Set source_code
     * @param string $sourceCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setSourceCode($sourceCode);
}

