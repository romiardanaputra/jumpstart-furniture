<?php

namespace App\Contracts\Services;

interface XenditServiceInterface
{
    /**
     * Create a Xendit Invoice
     * @param array $data ['external_id', 'amount', 'payer_email', 'description', 'items']
     * @return array ['invoice_url' => string, 'invoice_id' => string]
     */
    public function createInvoice(array $data): array;

    /**
     * Validate incoming Xendit callback
     * @param array $payload
     * @param string $token
     * @return bool
     */
    public function validateCallback(array $payload, string $token): bool;
}
