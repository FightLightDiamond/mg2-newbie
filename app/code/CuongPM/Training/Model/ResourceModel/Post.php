<?php


namespace CuongPM\Training\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\PredefinedId;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Provides possibility of saving entity with predefined/pre-generated id
     */
    use PredefinedId;

    /**#@+
     * Constants related to specific db layer
     */
    private const TABLE_NAME_STOCK = 'cuongpm_posts';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME_STOCK, 'id');
    }
}
