<?php
namespace App\Containers;

class Blog
{
    private $topicId;
    private $userId;
    private $title;
    private $slug;
    private $content;
    private $createdAt;

    public function __construct(
        int $topicId,
        int $userId,
        string $title,
        string $slug,
        string $content,
        string $createdAt
    ) {
        $this->topicId = $topicId;
        $this->userId = $userId;
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getTopicId(): int
    {
        return $this->topicId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
