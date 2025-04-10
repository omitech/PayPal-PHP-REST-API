<?php

namespace PayPalRestApi\Product\Response;

class ProductResponse
{
    private string $id;
    private string $name;
    private string $description;
    private string $type;
    private string $category;
    private string $imageUrl;
    private string $homeUrl;
    private string $createTime;
    private string $updateTime;
    private array $links;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->name = $response['name'];
        $this->description = $response['description'];
        $this->type = $response['type'];
        $this->category = $response['category'];
        $this->imageUrl = $response['image_url'];
        $this->homeUrl = $response['home_url'];
        $this->createTime = $response['create_time'];
        $this->updateTime = $response['update_time'];
        $this->links = $response['links'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getHomeUrl(): string
    {
        return $this->homeUrl;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}
