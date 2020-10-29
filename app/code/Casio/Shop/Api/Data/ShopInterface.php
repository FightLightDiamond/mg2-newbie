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
    const TEL = 'tel';
    const NAME = 'name';
    const HOLIDAYS = 'holidays';
    const CODE = 'code';
    const BUSINESS_HOURS = 'business_hours';
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
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $shopName
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setName($shopName);

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
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $shopCode
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setCode($shopCode);

    /**
     * Get tel
     * @return string|null
     */
    public function getTel();

    /**
     * Set tel
     * @param string $shopTel
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setTel($shopTel);

    /**
     * Get business_hours
     * @return string|null
     */
    public function getBusinessHours();

    /**
     * Set business_hours
     * @param string $shopBusinessHours
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setBusinessHours($shopBusinessHours);

    /**
     * Get holidays
     * @return string|null
     */
    public function getHolidays();

    /**
     * Set holidays
     * @param string $shopHolidays
     * @return \Casio\Shop\Api\Data\ShopInterface
     */
    public function setHolidays($shopHolidays);

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

