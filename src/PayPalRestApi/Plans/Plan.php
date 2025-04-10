<?php

namespace PayPalRestApi\Plans;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Plans\Response\PlanResponse;

class Plan
{
    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }

    public function create(
        string $productId,
        string $name,
        string $description,
        BillingCycle $billingCycle
    ): array {
        return $this->client->request('POST', '/v1/billing/plans', [
            'product_id' => $productId,
            'name' => $name,
            'description' => $description,
            'billing_cycles' => [
                $billingCycle->toArray()
            ],
            'payment_preferences' => [
                'auto_bill_outstanding' => true,
                'setup_fee' => [
                    'value' => $billingCycle->getSetupFee(),
                    'currency_code' => strtoupper($billingCycle->getCurrency())
                ],
                'setup_fee_failure_action' => 'CONTINUE',
                'payment_failure_threshold' => $billingCycle->getFailureThreshold()
            ]
        ]);
    }

    public function activate(string $planId): array
    {
        return $this->client->request('POST', "/v1/billing/plans/{$planId}/activate");
    }

    public function deactivate(string $planId): array
    {
        return $this->client->request('POST', "/v1/billing/plans/{$planId}/deactivate");
    }

    public function get(string $planId): PlanResponse
    {
        $response = $this->client->request('GET', "/v1/billing/plans/{$planId}");

        return PlanResponse::fromApiResponse($response);
    }
  
    public function list(array $params = []): array
    {
        $query = http_build_query($params);
        $uri = '/v1/billing/plans' . ($query ? "?$query" : '');

        // Get the raw plans from PayPal API
        $response = $this->client->request('GET', $uri);

        // Map each plan array into a PlanResponse object
        $plans = array_map(
            fn(array $planData) => PlanResponse::fromApiResponse($planData),
            $response['plans'] ?? []
        );

        return $plans;
    }
}
