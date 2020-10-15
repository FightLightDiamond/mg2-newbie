<?php

namespace CuongPM\GraphQLDev\Model\Resolver;

use CuongPM\Training\Api\PostRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Posts implements ResolverInterface
{

    private $postRepository;

    private $searchCriteriaBuilder;

    public function __construct(PostRepositoryInterface $postRepository, SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $this->vaildateArgs($args);
        $searchCriteria = $this->searchCriteriaBuilder->build('Post', $args);
        $searchCriteria->setCurrentPage($args['currentPage']);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->postRepository->getList($searchCriteria);

        return [
            'total_count' => $searchResult->getTotalCount(),
            'items' => $searchResult->getItems(),
        ];
//        return [
//            'total_count' => 2,
//            'items' => [],
//        ];
    }

    /**
     * @param array $args
     * @throws GraphQlInputException
     */
    private function vaildateArgs(array $args): void
    {
        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }
        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }
}
