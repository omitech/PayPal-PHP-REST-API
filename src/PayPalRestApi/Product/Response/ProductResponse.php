<?php

namespace PayPalRestApi\Product\Response;

class ProductResponse
{
    private string $id;
    private string $name;
    private string $description;
    private string $type;
    private string $createTime;
    private string $updateTime;
    private array $links;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->name = $response['name'];
        $this->description = $response['description'];
        $this->type = $response['type'];
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

        // Convert to array
        public function toArray(): array
        {
            return [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'type' => $this->getType(),
                'create_time' => $this->getCreateTime(),
                'update_time' => $this->getUpdateTime(),
                'links' => $this->getLinks(),
            ];
        }
}
