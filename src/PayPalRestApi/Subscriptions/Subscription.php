<?php

namespace PayPalRestApi\Subscriptions;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Subscriptions\Response\SubscriptionResponse;

class Subscription
{
    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }
    
    public function create(SubscriptionData $subscriptionData): SubscriptionResponse
    {
        $response = $this->client->request('POST', '/v1/billing/subscriptions', $subscriptionData->toArray());

        return new SubscriptionResponse($responseBody);
    }

    public function get(string $subscriptionId): SubscriptionResponse
    {
        $response = $this->client->request('GET', "/v1/billing/subscriptions/{$subscriptionId}");

        return new SubscriptionResponse($responseBody);
    }

    public function cancel(string $subscriptionId, string $reason = ''): array
    {
        return $this->client->request('POST', "/v1/billing/subscriptions/{$subscriptionId}/cancel", [
            'reason' => $reason
        ]);
    }

    public function activate(string $subscriptionId): array
    {
        return $this->client->request('POST', "/v1/billing/subscriptions/{$subscriptionId}/activate");
    }

    public function suspend(string $subscriptionId, string $reason = ''): array
    {
        return $this->client->request('POST', "/v1/billing/subscriptions/{$subscriptionId}/suspend", [
            'reason' => $reason
        ]);
    }
}
