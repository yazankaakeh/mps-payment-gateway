<?php

namespace tests;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yazan\MpsLibrary\DTO\PaymentRequest;

class PaymentRequestTest extends TestCase
{
    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new PaymentRequest(
            product: 'Test Product',
            transactionFee: 1.0,
            recipientName: 'John Doe',
            recipientPhone: '0123456789',
            recipientEmail: 'invalid-email',
            cardHolder: 'John Doe',
            cardNumber: '4111111111111111',
            cardExpiryDate: '12/26',
            cvc2: '123'
        );
    }
}