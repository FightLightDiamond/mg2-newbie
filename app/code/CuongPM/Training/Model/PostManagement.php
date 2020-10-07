<?php

namespace CuongPM\Training\Model;

class PostManagement implements \CuongPM\Training\Api\PostManagementInterface
{
    public function getPost()
    {
        return 'api GET return the $param ';
    }

    public function store()
    {
        return [1, 2, 3, 5];
    }
}
