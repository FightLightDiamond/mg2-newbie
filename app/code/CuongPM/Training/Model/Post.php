<?php

namespace CuongPM\Training\Model;

use CuongPM\Training\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Post extends AbstractExtensibleModel
{
    protected function _construct()
    {
        $this->_init(\CuongPM\Training\Model\ResourceModel\Post::class);
    }
}
