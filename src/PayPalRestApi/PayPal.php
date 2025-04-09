<?php

namespace PayPalRestApi;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Plans\Plan;
use PayPalRestApi\Subscriptions\Subscription;
use PayPalRestApi\Product\Product;
use PayPalRestApi\Order\Order;

class PayPal
{
    public Plan $plan;
    public Subscription $subscription;
    public Product $product;

    private PayPalClient $client;

    public function __construct(string $clientId, string $secret, bool $sandbox = false)
    {
        $this->client = new PayPalClient($clientId, $secret, $sandbox);
        
        // Initialize other service classes
        $this->product = new Product($this->client);
        $this->plan = new Plan($this->client);
        $this->subscription = new Subscription($this->client);
        $this->order = new Order($this->client);
        
    }

    public function getClient(): PayPalClient
    {
        return $this->client;
    }
}
