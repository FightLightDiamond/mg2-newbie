<?php

declare(strict_types=1);

namespace CuongPM\Training\Api\Data;

/**
 * Interface PostInterface
 * @package CuongPM\GraphQLDev\Api\Data
 */
interface PostInterface
{
    const NAME = 'name';
    const CONTENT = 'content';
    const STATUS = 'status';

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void;

    /**
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void;
}
