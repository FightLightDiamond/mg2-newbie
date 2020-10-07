<?php

namespace CuongPM\Training\Api;


interface PostManagementInterface
{

    /**
     * GET for Post api
     * @return string
     */

    public function getPost();

    /**
     * GET for Post api
     * @return array
     */
    public function store();
}
