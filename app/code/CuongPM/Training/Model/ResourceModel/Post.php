<?php


namespace CuongPM\Training\Model\ResourceModel;


class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cuongpm_posts', 'id');
    }
}
