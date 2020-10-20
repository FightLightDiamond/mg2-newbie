<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model\ResourceModel\PhysicalStore;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'physicalstore_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Casio\PhysicalStore\Model\PhysicalStore::class,
            \Casio\PhysicalStore\Model\ResourceModel\PhysicalStore::class
        );
    }
}

