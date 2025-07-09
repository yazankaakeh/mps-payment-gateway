<?php

namespace Yazan\MpsLibrary\DTO;

use InvalidArgumentException;

class PaymentRequest
{
    public string $product;
    public float $transactionFee;
    public string $recipientName;
    public string $recipientPhone;
    public string $recipientEmail;
    public string $cardHolder;
    public string $cardNumber;
    public string $cardExpiryDate;
    public string $cvc2;

    public function __construct(
        string $product,
        float $transactionFee,
        string $recipientName,
        string $recipientPhone,
        string $recipientEmail,
        string $cardHolder,
        string $cardNumber,
        string $cardExpiryDate,
        string $cvc2
    ) {
        // Basic Validation
        if (empty($product)) {
            throw new InvalidArgumentException('Product is required.');
        }

        if ($transactionFee < 0) {
            throw new InvalidArgumentException('Transaction fee cannot be negative.');
        }

        if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid recipient email.');
        }

        if (!preg_match('/^\d{16}$/', $cardNumber)) {
            throw new InvalidArgumentException('Card number must be 16 digits.');
        }

        if (!preg_match('/^\d{2}\/\d{2}$/', $cardExpiryDate)) {
            throw new InvalidArgumentException('Card expiry date must be in MM/YY format.');
        }

        if (!preg_match('/^\d{3,4}$/', $cvc2)) {
            throw new InvalidArgumentException('Invalid CVC2.');
        }

        // Assign properties
        $this->product = $product;
        $this->transactionFee = $transactionFee;
        $this->recipientName = $recipientName;
        $this->recipientPhone = $recipientPhone;
        $this->recipientEmail = $recipientEmail;
        $this->cardHolder = $cardHolder;
        $this->cardNumber = $cardNumber;
        $this->cardExpiryDate = $cardExpiryDate;
        $this->cvc2 = $cvc2;
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product,
            'transaction_fee' => $this->transactionFee,
            'recipient_name' => $this->recipientName,
            'recipient_phone' => $this->recipientPhone,
            'recipient_email' => $this->recipientEmail,
            'card_holder' => $this->cardHolder,
            'card_number' => $this->cardNumber,
            'card_expiry_date' => $this->cardExpiryDate,
            'cvc2' => $this->cvc2,
        ];
    }
}