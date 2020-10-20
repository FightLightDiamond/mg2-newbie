<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casio\PhysicalStore\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\PredefinedId;

class PhysicalStore extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Provides possibility of saving entity with predefined/pre-generated id
     */
    use PredefinedId;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('casio_physicalstore_physicalstore', 'physicalstore_id');
    }
}

