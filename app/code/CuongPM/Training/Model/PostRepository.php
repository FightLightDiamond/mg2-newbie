<?php


namespace CuongPM\Training\Model;

use CuongPM\Training\Api\Data\PostInterface;
use CuongPM\Training\Api\PostRepositoryInterface;
use CuongPM\Training\Model\ResourceModel\Post as PostResourceModel;
use CuongPM\Training\Model\ResourceModel\PostCollection;
use CuongPM\Training\Model\ResourceModel\PostCollectionFactory;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;


class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostCollectionFactory
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
    private $postSearchResultsInterfaceFactory;
    /**
     * @var PostResourceModel
     */
    private $postResourceModel;

    public function __construct(
        PostCollectionFactory $postCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $postSearchResultsInterfaceFactory,
        PostResourceModel $postResourceModel
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->postSearchResultsInterfaceFactory = $postSearchResultsInterfaceFactory;
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

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->postSearchResultsInterfaceFactory->create();
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
}
