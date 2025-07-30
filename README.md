# 💳 MPS Payment Gateway SDK for PHP

A lightweight, secure, and easy-to-use PHP SDK for integrating with the **MPS Payment Gateway**.  
This package allows you to authenticate using client credentials and create payments with full control and validation.

---

## 🚀 Features

- 🌐 Token-based authentication (Client Credentials)
- 🧾 Secure payment creation
- ✅ Strong data validation with typed request DTO
- ⚙️ Built with GuzzleHTTP
- 📦 PSR-4 autoloaded and Composer-ready

---

## 🧱 Installation

Install via [Composer](https://getcomposer.org):

```bash
composer require yazzzon/mps-payment-library
```

Then run:

```bash
composer update
```

---

## ⚙️ Environment Setup

Create a .env file in your project root:

```bash
PAYMENT_BASE_URL=https://your-gateway.com
PAYMENT_CLIENT_ID=your-client-id
PAYMENT_CLIENT_SECRET=your-client-secret
```

---

## 🧠 Usage

### 1. Authenticate

```php
use Yazan\MpsLibrary\MpsPayment;

$gateway = new MpsPayment(); // values loaded from .env

if ($gateway->authenticate()) {
    echo "Authenticated successfully!";
} else {
    echo "Authentication failed!";
}
```
### 2. Create a Payment

```php
use Yazan\MpsLibrary\DTO\PaymentRequest;

$request = new PaymentRequest(
    product: 'Pro Subscription',
    transactionFee: 2.5,
    recipientName: 'Zahraa Ali',
    recipientPhone: '07701234567',
    recipientEmail: 'zahraa@example.com',
    cardHolder: 'Zahraa Ali',
    cardNumber: '4111111111111111',
    cardExpiryDate: '12/26',
    cvc2: '123'
);

$response = $gateway->createPayment($request);
print_r($response);
```

🔐 All fields are validated before sending the request.

---

## 📜 License

This project is licensed under the [MIT License](LICENSE).

You are free to use, modify, and distribute this software with attribution.  
See the full license text in the `LICENSE` file.

---

## 👤 Author

**Yazan Kaakeh**  
📧 [yazanka187@gmail.com](mailto:yazanka187@gmail.com)  
🔗 [GitHub: yazankaakeh](https://github.com/yazankaakeh)

---

## 🤝 Contributions

Contributions, issues, and feature requests are welcome!  
Please feel free to fork the repository and submit a pull request.

If you find a bug or have a suggestion, please open an issue on GitHub.

> Let's build better tools together 🚀

---
