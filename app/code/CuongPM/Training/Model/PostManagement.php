<?php

namespace CuongPM\Training\Model;

//=======================================================
// POST API LOGIC
//=======================================================

class PostManagement implements \CuongPM\Training\Api\PostManagementInterface
{
    protected $factory;
    protected $collectionFactory;
    protected $request;
    protected $logger;

    public function __construct(
        \CuongPM\Training\Model\PostFactory $factory,
        \CuongPM\Training\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->factory = $factory;
        $this->request = $request;
        $this->logger = $logger;
    }

    /**
     * @return array|string
     */
    public function index()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getData();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function store()
    {
        $data = [
            'name' => $this->request->getParam('name'),
            'status' => $this->request->getParam('status'),
            'content' => $this->request->getParam('content')
        ];

        $model = $this->factory->create($data);
        $model->addData($data)->save();

        return $data;
    }

    /**
     * Find post
     * @param int $id
     * @return array|ResourceModel\Post\Collection
     */
    public function show($id)
    {
        // Test custom format response
        try {
            $post = $this->factory->create()
                ->load($id)->toArray();

            $res = [
                'status' => 'ok',
                'data' => $post
            ];

            // Return data format json
            header('Content-Type: application/json');
            echo json_encode($res);
            exit;
        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }

    /**
     * Update post
     * @param int $id
     * @return array|string[]
     */
    public function update($id)
    {
        $post = $this->factory->create()
            ->load($id)
            ->setName($this->request->getParam('name'))
            ->setStatus($this->request->getParam('status'))
            ->setContent($this->request->getParam('content'))
            ->save();

        return $post->toArray();
    }

    /**
     * Destroy post
     * @param int $id
     * @return array|string
     */
    public function destroy($id)
    {
        return $this->factory->create()
            ->load($id)
            ->delete()->toArray();
    }
}
