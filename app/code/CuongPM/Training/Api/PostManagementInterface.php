<?php

namespace CuongPM\Training\Api;

//=======================================================
// POST API INTERFACE
//=======================================================

interface PostManagementInterface
{

    /**
     * GET for Post api
     * @return \Magento\Framework\Controller\Result\Json|mixed[]
     */
    public function index();

    /**
     * Create for Post api
     * @return array
     */
    public function store();

    /**
     * Find for Post api
     * @param int $id
     * @return \Magento\Framework\Controller\Result\Json|mixed[]
     */
    public function show($id);

    /**
     * Update for Post api
     * @param int $id
     * @return mixed
     */
    public function update($id);

    /**
     * Destroy for Post api
     * @param int $id
     * @return array
     */
    public function destroy($id);
}
