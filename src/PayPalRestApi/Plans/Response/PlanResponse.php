<?php

namespace PayPalRestApi\Plans\Response;

use PayPalRestApi\Plans\BillingCycleBuilder;
use PayPalRestApi\Plans\BillingCycle;

/**
 * DTO to hold a simplified view of a PayPal plan
 */
class PlanResponse
{
    private string $id;
    private string $name;
    private string $description;
    
    /** @var BillingCycle[] */
    private array $billingCycles;

    private array $payee;

    public function __construct(
        string $id,
        string $name,
        string $description,
        array $billingCycles,
        array $payee
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->billingCycles = $billingCycles;
        $this->payee = $payee;
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

    /**
     * @return BillingCycle[]
     */
    public function getBillingCycles(): array
    {
        return $this->billingCycles;
    }

    public function getPayee(): array
    {
        return $this->payee;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'billing_cycles' => array_map(fn(BillingCycle $cycle) => $cycle->toArray(), $this->billingCycles),
            'payee' => $this->payee
        ];
    }

    public static function fromApiResponse(array $plan): self
    {
        $billingCycles = [];

        foreach ($plan['billing_cycles'] as $cycle) {
            $price = (float) $cycle['pricing_scheme']['fixed_price']['value'];
            $currency = $cycle['pricing_scheme']['fixed_price']['currency_code'];

            $builder = (new BillingCycleBuilder())
                ->setIntervalUnit($cycle['frequency']['interval_unit'])
                ->setIntervalCount($cycle['frequency']['interval_count'])
                ->setTenureType($cycle['tenure_type'])
                ->setPrice($price)
                ->setCurrency($currency)
                ->setSequence($cycle['sequence'] ?? 1)
                ->setTotalCycles($cycle['total_cycles'] ?? 0)
                ->setFailureThreshold($plan['payment_preferences']['payment_failure_threshold'] ?? 3)
                ->setSetupFee((float) ($plan['payment_preferences']['setup_fee']['value'] ?? 0));

            $billingCycles[] = $builder->build();
        }

        return new self(
            $plan['id'],
            $plan['name'],
            $plan['description'],
            $billingCycles,
            $plan['payee'] ?? []
        );
    }
}