<?php


namespace CuongPM\Training\Model;

use CuongPM\Training\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Post extends AbstractExtensibleModel implements PostInterface
{
    protected function _construct()
    {
        $this->_init(\CuongPM\Training\Model\ResourceModel\Post::class);
    }

    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent(?string $content): void
    {
        $this->setData(self::CONTENT, $content);
    }

    public function getStatus(): ?int
    {
        return $this->getData(self::STATUS);
    }

    public function setStatus(?int $status): void
    {
        // TODO: Implement setStatus() method.
    }
}
