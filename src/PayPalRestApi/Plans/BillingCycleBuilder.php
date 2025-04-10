<?php

namespace PayPalRestApi\Plans;

/**
 * helper class to build BullingCycle
 * Usage example
 * $billingCycle = (new BillingCycleBuilder())
 *   ->setIntervalUnit(BillingCycle::INTERVAL_MONTH)
 *   ->setIntervalCount(1)
 *   ->setTenureType(BillingCycle::TENURE_REGULAR)
 *   ->setPrice(10.00)
 *   ->setCurrency('USD')
 *   ->build();
 */
class BillingCycleBuilder
{
    private string $intervalUnit;
    private int $intervalCount;
    private string $tenureType;
    private float $price;
    private string $currency;
    private int $sequence = 1;
    private int $totalCycles = 0;
    private int $failure_threshold = 3;
    private float $setup_fee = 0;

    public function setIntervalUnit(string $intervalUnit): self {
        $this->intervalUnit = strtoupper($intervalUnit);
        return $this;
    }

    public function setIntervalCount(int $intervalCount): self {
        $this->intervalCount = $intervalCount;
        return $this;
    }

    public function setTenureType(string $tenureType): self {
        $this->tenureType = strtoupper($tenureType);
        return $this;
    }

    public function setPrice(float $price): self {
        $this->price = $price;
        return $this;
    }

    public function setCurrency(string $currency): self {
        $this->currency = strtoupper($currency);
        return $this;
    }

    public function setSequence(int $sequence): self {
        $this->sequence = $sequence;
        return $this;
    }

    public function setTotalCycles(int $totalCycles): self {
        $this->totalCycles = $totalCycles;
        return $this;
    }

    public function setFailureThreshold(int $threshold): self {
        $this->failure_threshold = $threshold;
        return $this;
    }

    public function setSetupFee(float $setup_fee): self {
        $this->setup_fee = $setup_fee;
        return $this;
    }

    public function build(): BillingCycle {
        return new BillingCycle(
            $this->intervalUnit,
            $this->intervalCount,
            $this->tenureType,
            $this->price,
            $this->currency,
            $this->sequence,
            $this->totalCycles,
            $this->failure_threshold,
            $this->setup_fee
        );
    }
}
