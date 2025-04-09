<?php

namespace PayPalRestApi\Orders;

class OrderData
{
    float string $amount;
    private string $currency;
    private string $description;
    private string $customId;

    // Constructor to initialize order data
    public function __construct(
        float $amount,
        string $currency,
        string $customId,
        string $description,
    ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->customId = $customId;
        $this->description = $description;
    }

    // Getters for order data
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCustomId(): string
    {
        return $this->customId;
    }

    // Convert order data to the format required by PayPal
    public function toPayPalFormat(): array
    {
        return [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "custom_id" => $this->getCustomId(),
                    "amount" => [
                        "value" => $this->getAmount(),
                        "currency_code" => $this->getCurrency(),
                    ],
                    'description' => $this->getDescription(),
                ]
            ],
            "application_context" => [
                'shipping_preference' => 'NO_SHIPPING'
            ]
        ];
    }
}
