<?php

namespace PayPalRestApi\Webhook;

/**
 * full list of events https://developer.paypal.com/api/rest/webhooks/event-names/
 */
class EventTypes
{
    public const BILLING_PLAN_CREATED = 'BILLING.PLAN.CREATED';
    public const BILLING_PLAN_UPDATED = 'BILLING.PLAN.UPDATED';
    public const BILLING_SUBSCRIPTION_CANCELLED = 'BILLING.SUBSCRIPTION.CANCELLED';
    public const BILLING_SUBSCRIPTION_CREATED = 'BILLING.SUBSCRIPTION.CREATED';
    public const BILLING_SUBSCRIPTION_REACTIVATED = 'BILLING.SUBSCRIPTION.REACTIVATED';
    public const BILLING_SUBSCRIPTION_SUSPENDED = 'BILLING.SUBSCRIPTION.SUSPENDED';
    public const BILLING_SUBSCRIPTION_UPDATED = 'BILLING.SUBSCRIPTION.UPDATED';
    public const BILLING_SUBSCRIPTION_EXPIRED = 'BILLING.SUBSCRIPTION.EXPIRED';

    public const CHECKOUT_ORDER_APPROVED = 'CHECKOUT.ORDER.APPROVED';

    public const CUSTOMER_DISPUTE_CREATED = 'CUSTOMER.DISPUTE.CREATED';
    public const CUSTOMER_DISPUTE_UPDATED = 'CUSTOMER.DISPUTE.UPDATED';
    public const CUSTOMER_DISPUTE_RESOLVED = 'CUSTOMER.DISPUTE.RESOLVED';

    public const INVOICING_INVOICE_CANCELLED = 'INVOICING.INVOICE.CANCELLED';
    public const INVOICING_INVOICE_PAID = 'INVOICING.INVOICE.PAID';
    public const INVOICING_INVOICE_PAYMENT_FAILED = 'INVOICING.INVOICE.PAYMENT-FAILED';
    public const INVOICING_INVOICE_REFUNDED = 'INVOICING.INVOICE.REFUNDED';
    public const INVOICING_INVOICE_SENT = 'INVOICING.INVOICE.SENT';

    public const PAYMENT_AUTHORIZATION_CREATED = 'PAYMENT.AUTHORIZATION.CREATED';
    public const PAYMENT_AUTHORIZATION_VOIDED = 'PAYMENT.AUTHORIZATION.VOIDED';
    public const PAYMENT_CAPTURE_COMPLETED = 'PAYMENT.CAPTURE.COMPLETED';
    public const PAYMENT_CAPTURE_DENIED = 'PAYMENT.CAPTURE.DENIED';
    public const PAYMENT_CAPTURE_PENDING = 'PAYMENT.CAPTURE.PENDING';
    public const PAYMENT_CAPTURE_REFUNDED = 'PAYMENT.CAPTURE.REFUNDED';
    public const PAYMENT_CAPTURE_REVERSED = 'PAYMENT.CAPTURE.REVERSED';

    public const PAYMENT_PAYOUTS_ITEM_CANCELLED = 'PAYMENT.PAYOUTS-ITEM.CANCELLED';
    public const PAYMENT_PAYOUTS_ITEM_DENIED = 'PAYMENT.PAYOUTS-ITEM.DENIED';
    public const PAYMENT_PAYOUTS_ITEM_FAILED = 'PAYMENT.PAYOUTS-ITEM.FAILED';
    public const PAYMENT_PAYOUTS_ITEM_HELD = 'PAYMENT.PAYOUTS-ITEM.HELD';
    public const PAYMENT_PAYOUTS_ITEM_REFUNDED = 'PAYMENT.PAYOUTS-ITEM.REFUNDED';
    public const PAYMENT_PAYOUTS_ITEM_RETURNED = 'PAYMENT.PAYOUTS-ITEM.RETURNED';
    public const PAYMENT_PAYOUTS_ITEM_SUCCEEDED = 'PAYMENT.PAYOUTS-ITEM.SUCCEEDED';
    public const PAYMENT_PAYOUTS_ITEM_UNCLAIMED = 'PAYMENT.PAYOUTS-ITEM.UNCLAIMED';

    public const PAYMENT_SALE_COMPLETED = 'PAYMENT.SALE.COMPLETED';
    public const PAYMENT_SALE_DENIED = 'PAYMENT.SALE.DENIED';
    public const PAYMENT_SALE_PENDING = 'PAYMENT.SALE.PENDING';
    public const PAYMENT_SALE_REFUNDED = 'PAYMENT.SALE.REFUNDED';
    public const PAYMENT_SALE_REVERSED = 'PAYMENT.SALE.REVERSED';

    public const RISK_DISPUTE_CREATED = 'RISK.DISPUTE.CREATED';

    public const VAULT_CARD_CREATED = 'VAULT.CARD.CREATED';
    public const VAULT_CARD_UPDATED = 'VAULT.CARD.UPDATED';
    public const VAULT_CARD_DELETED = 'VAULT.CARD.DELETED';

    public const VAULT_CUSTOMER_CREATED = 'VAULT.CUSTOMER.CREATED';
    public const VAULT_CUSTOMER_UPDATED = 'VAULT.CUSTOMER.UPDATED';
    public const VAULT_CUSTOMER_DELETED = 'VAULT.CUSTOMER.DELETED';
}
