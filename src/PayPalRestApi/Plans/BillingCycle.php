<?php

namespace PayPalRestApi\Plans;

class BillingCycle
{
    public const INTERVAL_DAY = 'DAY';
    public const INTERVAL_WEEK = 'WEEK';
    public const INTERVAL_MONTH = 'MONTH';
    public const INTERVAL_YEAR = 'YEAR';

    public const TENURE_REGULAR = 'REGULAR';
    public const TENURE_TRIAL = 'TRIAL';

    private string $intervalUnit;
    private int $intervalCount;
    private string $tenureType;
    private float $price;
    private string $currency;
    private int $sequence;
    private int $totalCycles;
    private int $failure_threshold;
    private float $setup_fee;

    public function __construct(
        string $intervalUnit,
        int $intervalCount,
        string $tenureType,
        float $price,
        string $currency,
        int $sequence = 1,
        int $totalCycles = 0,
        int $failure_threshold = 3,
        float $setup_fee = 0,
    ) {
        $this->intervalUnit = strtoupper($intervalUnit);
        $this->intervalCount = $intervalCount;
        $this->tenureType = strtoupper($tenureType);
        $this->price = $price;
        $this->currency = strtoupper($currency);
        $this->sequence = $sequence;
        $this->totalCycles = $totalCycles;
        $this->failure_threshold = $failure_threshold;
        $this->setup_fee = $setup_fee;
    }

    public function toArray(): array
    {
        return [
            'frequency' => [
                'interval_unit' => $this->intervalUnit,
                'interval_count' => $this->intervalCount
            ],
            'tenure_type' => $this->tenureType,
            'sequence' => $this->sequence,
            'total_cycles' => $this->totalCycles,
            'pricing_scheme' => [
                'fixed_price' => [
                    'value' => $this->getPrice(),
                    'currency_code' => $this->currency
                ]
            ]
        ];
    }

    public function getIntervalUnit(): string
    {
        return $this->intervalUnit;
    }

    public function getIntervalCount(): int
    {
        return $this->intervalCount;
    }

    public function getTenureType(): string
    {
        return $this->tenureType;
    }

    public function getPrice(): float
    {
        return number_format($this->price, 2, '.', '');
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getTotalCycles(): int
    {
        return $this->totalCycles;
    }

    public function getFailureThreshold(): int
    {
        return $this->failure_threshold;
    }

    public function getSetupFee(): string
    {
        return number_format($this->setup_fee, 2, '.', '');
    }
}
