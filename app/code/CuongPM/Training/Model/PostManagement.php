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
    protected $response;
    protected $logger;
    private $jsonResultFactory;

    public function __construct(
        \CuongPM\Training\Model\PostFactory $factory,
        \CuongPM\Training\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Webapi\Rest\Response $response,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->factory = $factory;
        $this->request = $request;
        $this->response = $response;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->logger = $logger;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json|string
     */
    public function index()
    {
        $collection = $this->collectionFactory->create();
        $posts = $collection->getData();
        $result = $this->jsonResultFactory->create();
        $result->setData($posts);
        return $result;
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
     * @return \Magento\Framework\Controller\Result\Json|mixed[]|void
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
        } catch (\Exception $exception) {
            $res = [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
        }
        // Return data format json
        $this->response->setContent(json_encode($res))->sendResponse();
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
