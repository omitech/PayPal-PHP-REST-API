<?php

namespace PayPalRestApi\Subscriptions;

class SubscriptionData
{
    private string $planId;
    private string $custom_id;
    private ?string $startTime;
    
    public function __construct(
        string $planId,
        string $custom_id,
        ?string $startTime = null,
    ) {
        $this->planId = $planId;
        $this->custom_id = $custom_id;
        $this->startTime = $startTime;        
    }

    public function toArray(): array
    {
        $data = [
            'plan_id' => $this->planId,
            'custom_id' => $this->custom_id,
        ];

        if ($this->startTime) {
            $data['start_time'] = $this->startTime;
        }
        
        return $data;
    }
}
