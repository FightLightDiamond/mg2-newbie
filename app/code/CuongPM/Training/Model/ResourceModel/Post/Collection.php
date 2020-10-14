<?php

namespace CuongPM\Training\Model\ResourceModel\Post;

use CuongPM\Training\Model\Post;
use CuongPM\Training\Model\ResourceModel\Post as PostResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
