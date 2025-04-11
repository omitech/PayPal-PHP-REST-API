<?php

namespace PayPalRestApi\Subscriptions\Response;

use PayPalRestApi\Subscriptions\Response\BillingInfoResponse;

class SubscriptionResponse
{
    private string $id;
    private string $status;
    private string $statusUpdateTime;
    private string $planId;
    private bool $planOverridden;
    private string $startTime;
    private array $subscriber;
    private string $createTime;
    private ?string $customId;
    private ?BillingInfoResponse $billingInfo;
    private array $links;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->status = $response['status'];
        $this->statusUpdateTime = $response['status_update_time'];
        $this->planId = $response['plan_id'];
        $this->planOverridden = $response['plan_overridden'];
        $this->startTime = $response['start_time'];
        $this->subscriber = $response['subscriber'];
        $this->createTime = $response['create_time'];
        $this->customId = $response['custom_id'];
        $this->links = $response['links'];
        $this->billingInfo = new BillingInfoResponse($response['billing_info'] ?? []);
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

    public function getSubscriber(): array
    {
        return $this->subscriber;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function getCustomId(): ?string
    {
        return $this->customId;
    }

    public function getBillingInfo(): ?BillingInfoResponse
    {
        return $this->billingInfo;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_update_time' => $this->statusUpdateTime,
            'plan_id' => $this->planId,
            'custom_id' => $this->customId,
            'plan_overridden' => $this->planOverridden,
            'start_time' => $this->startTime,
            'subscriber' => $this->subscriber,
            'create_time' => $this->createTime,
            'billing_info' => $this->billingInfo?->toArray(),
            'links' => $this->links,
        ];
    }
}
