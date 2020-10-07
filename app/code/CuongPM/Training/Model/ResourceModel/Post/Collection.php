<?php


namespace CuongPM\Training\Model\ResourceModel\Post;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected function _construct()
    {
        $this->_init('CuongPM\Training\Model\Post', 'CuongPM\Training\Model\ResourceModel\Post');
    }
}
