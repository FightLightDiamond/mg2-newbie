<?php


namespace CuongPM\Training\Model;


class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('CuongPM\Training\Model\ResourceModel\Post');
    }
}
