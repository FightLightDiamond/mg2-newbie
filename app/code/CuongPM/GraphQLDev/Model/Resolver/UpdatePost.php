<?php

namespace CuongPM\GraphQLDev\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class UpdatePost implements ResolverInterface
{
    /**
     * @var \CuongPM\Training\Model\PostFactory
     */
    private $factory;
    /**
     * @var \CuongPM\Training\Model\ResourceModel\Post\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var ValueFactory
     */
    private $valueFactory;

    public function __construct(
        ValueFactory $valueFactory,
        \CuongPM\Training\Model\PostFactory $factory,
        \CuongPM\Training\Model\ResourceModel\Post\CollectionFactory $collectionFactory
    ) {
        $this->factory = $factory;
        $this->collectionFactory = $collectionFactory;
        $this->valueFactory = $valueFactory;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return \Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     * @throws GraphQlAuthorizationException
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($args['id'])) {
            throw new GraphQlAuthorizationException(
                __(
                    'id for post should be specified',
                    ['cuongpm_posts']
                )
            );
        }

        try {
            $post = $this->factory->create()
                ->load(3)
                ->setName('43242')
                ->setStatus(1)
                ->setContent('fkjdfks')
                ->save();

            $result = function () use ($post) {
                return !empty($post) ? $post->toArray() : [];
            };

            return ['cuongpm_post' => $this->valueFactory->create($result)];
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }
    }
}
