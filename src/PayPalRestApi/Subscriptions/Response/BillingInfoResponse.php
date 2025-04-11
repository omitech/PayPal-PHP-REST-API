<?php

namespace PayPalRestApi\Subscriptions\Response;

class BillingInfoResponse
{
    private float $outstandingBalance;
    private string $currency;

    private array $cycleExecutions = [];

    private float $lastPaymentAmount;
    private string $lastPaymentCurrency;
    private string $lastPaymentTime;

    private string $nextBillingTime;
    private int $failedPaymentsCount;

    public function __construct(array $billingInfo)
    {
        if (empty($billingInfo)) return null;

        // Outstanding Balance
        $this->outstandingBalance = (float) ($billingInfo['outstanding_balance']['value'] ?? 0.0);
        $this->currency = $billingInfo['outstanding_balance']['currency_code'] ?? 'XXX';

        // Cycle Executions
        $this->cycleExecutions = array_map(function ($cycle) {
            return [
                'tenure_type' => $cycle['tenure_type'] ?? '',
                'sequence' => (int) ($cycle['sequence'] ?? 0),
                'cycles_completed' => (int) ($cycle['cycles_completed'] ?? 0),
                'cycles_remaining' => (int) ($cycle['cycles_remaining'] ?? 0),
                'pricing_scheme_version' => (int) ($cycle['current_pricing_scheme_version'] ?? 0),
                'total_cycles' => (int) ($cycle['total_cycles'] ?? 0),
            ];
        }, $billingInfo['cycle_executions'] ?? []);

        // Last Payment
        $this->lastPaymentAmount = (float) ($billingInfo['last_payment']['amount']['value'] ?? 0.0);
        $this->lastPaymentCurrency = $billingInfo['last_payment']['amount']['currency_code'] ?? 'XXX';
        $this->lastPaymentTime = $billingInfo['last_payment']['time'] ?? '';

        // Next Billing Time
        $this->nextBillingTime = $billingInfo['next_billing_time'] ?? '';

        // Failed Payments Count
        $this->failedPaymentsCount = (int) ($billingInfo['failed_payments_count'] ?? 0);
    }

    // Getter methods
    public function getOutstandingBalance(): float
    {
        return $this->outstandingBalance;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCycleExecutions(): array
    {
        return $this->cycleExecutions;
    }

    public function getLastPaymentAmount(): float
    {
        return $this->lastPaymentAmount;
    }

    public function getLastPaymentCurrency(): string
    {
        return $this->lastPaymentCurrency;
    }

    public function getLastPaymentTime(): string
    {
        return $this->lastPaymentTime;
    }

    public function getNextBillingTime(): string
    {
        return $this->nextBillingTime;
    }

    public function getFailedPaymentsCount(): int
    {
        return $this->failedPaymentsCount;
    }

    // Convert to array
    public function toArray(): array
    {
        return [
            'outstanding_balance' => $this->getOutstandingBalance(),
            'currency' => $this->getCurrency(),
            'cycle_executions' => $this->getCycleExecutions(),
            'last_payment_amount' => $this->getLastPaymentAmount(),
            'last_payment_currency' => $this->getLastPaymentCurrency(),
            'last_payment_time' => $this->getLastPaymentTime(),
            'next_billing_time' => $this->getNextBillingTime(),
            'failed_payments_count' => $this->getFailedPaymentsCount(),
        ];
    }
}
