<?php

namespace PayPalRestApi\Subscriptions;

class SubscriptionData
{
    private string $planId;
    private string $subscriberEmail;
    private ?string $name;
    private ?string $startTime;
    private ?array $shippingAddress;

    public function __construct(
        string $planId,
        string $subscriberEmail,
        ?string $name = null,
        ?string $startTime = null,
        ?array $shippingAddress = null
    ) {
        $this->planId = $planId;
        $this->subscriberEmail = $subscriberEmail;
        $this->name = $name;
        $this->startTime = $startTime;
        $this->shippingAddress = $shippingAddress;
    }

    public function toArray(): array
    {
        $data = [
            'plan_id' => $this->planId,
            'subscriber' => [
                'email_address' => $this->subscriberEmail
            ]
        ];

        if ($this->name) {
            $data['subscriber']['name'] = ['given_name' => $this->name];
        }

        if ($this->startTime) {
            $data['start_time'] = $this->startTime;
        }

        if ($this->shippingAddress) {
            $data['subscriber']['shipping_address'] = $this->shippingAddress;
        }

        return $data;
    }
}
