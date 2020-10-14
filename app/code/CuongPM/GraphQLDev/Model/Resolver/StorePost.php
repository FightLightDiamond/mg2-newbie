<?php


namespace CuongPM\GraphQLDev\Model\Resolver;


use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class StorePost implements ResolverInterface
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
     * @inheritDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        try {
            $model = $this->factory->create();
            $post = $model->addData([
                "name" => $args['name'],
                "status" => $args['status'],
                "content" => $args['content']
            ])->save();

            $result = function () use ($post) {
                return !empty($post) ? $post : [];
            };

            return ['cuongpm_post' => $this->valueFactory->create($result)];
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }
    }
}
