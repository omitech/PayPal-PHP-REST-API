<?php

namespace PayPalRestApi\Subscriptions\Response;

class SubscriptionResponse
{
    private string $id;
    private string $status;
    private string $statusUpdateTime;
    private string $planId;
    private bool $planOverridden;
    private string $startTime;
    private string $quantity;
    private array $shippingAmount;
    private array $subscriber;
    private string $createTime;
    private array $links;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->status = $response['status'];
        $this->statusUpdateTime = $response['status_update_time'];
        $this->planId = $response['plan_id'];
        $this->planOverridden = $response['plan_overridden'];
        $this->startTime = $response['start_time'];
        $this->quantity = $response['quantity'];
        $this->shippingAmount = $response['shipping_amount'];
        $this->subscriber = $response['subscriber'];
        $this->createTime = $response['create_time'];
        $this->links = $response['links'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusUpdateTime(): string
    {
        return $this->statusUpdateTime;
    }

    public function getPlanId(): string
    {
        return $this->planId;
    }

    public function isPlanOverridden(): bool
    {
        return $this->planOverridden;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getShippingAmount(): array
    {
        return $this->shippingAmount;
    }

    public function getSubscriber(): array
    {
        return $this->subscriber;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}
