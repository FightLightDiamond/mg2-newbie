<?php

namespace CuongPM\Training\Model;

use CuongPM\Training\Api\Data\PostInterface;
use CuongPM\Training\Api\PostRepositoryInterface;
use CuongPM\Training\Model\ResourceModel\Post as PostResourceModel;
use CuongPM\Training\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostFactory
     */
    protected $factory;
    /**
     * @var CollectionFactory
     */
    private $postCollectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsInterfaceFactory;
    /**
     * @var PostResourceModel
     */
    private $postResourceModel;

    public function __construct(
        \CuongPM\Training\Model\PostFactory $factory,
        CollectionFactory $postCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        PostResourceModel $postResourceModel
    ) {
        $this->factory = $factory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->postResourceModel = $postResourceModel;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var PostCollection $postCollection */
        $postCollection = $this->postCollectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $postCollection);
        }

        $searchResult = $this->searchResultsInterfaceFactory->create();
        $searchResult->setItems($postCollection->getItems());
        $searchResult->setTotalCount($postCollection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }

    /**
     * @inheritDoc
     */
    public function save(PostInterface $post): void
    {
        try {
            $this->postResourceModel->save($post);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save Source'), $e);
        }
    }

    /**
     * @param $id
     * @param $name
     * @param $status
     * @param $content
     * @return array
     */
    public function update($id, $name, $status, $content)
    {
        $post = $this->factory->create()
            ->load($id);

        return $post->setName($name)
            ->setStatus($status)
            ->setContent($content)
            ->save();
    }
}
