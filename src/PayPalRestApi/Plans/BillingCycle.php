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
    

    public function __construct(
        string $intervalUnit,
        int $intervalCount,
        string $tenureType,
        float $price,
        string $currency
        int $sequence = 1,
        int $totalCycles = 0,
    
    ) {
        $this->intervalUnit = strtoupper($intervalUnit);
        $this->intervalCount = $intervalCount;
        $this->tenureType = strtoupper($tenureType);
        $this->price = $price;
        $this->currency = strtoupper($currency);
        $this->sequence = $sequence;
        $this->totalCycles = $totalCycles;
        
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
                    'value' => number_format($this->price, 2, '.', ''),
                    'currency_code' => $this->currency
                ]
            ]
        ];
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}
