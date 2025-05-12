
# Laravel SMPP

[![Latest Version](https://img.shields.io/packagist/v/isadma/laravel-smpp.svg?style=flat-square)](https://packagist.org/packages/isadma/laravel-smpp)
[![License](https://img.shields.io/packagist/l/isadma/laravel-smpp.svg?style=flat-square)](LICENSE)

A simple Laravel package to send SMS messages using the SMPP protocol, built on top of [alexandr-mironov/php-smpp](https://github.com/alexandr-mironov/php-smpp).

---

## 🚀 Features

- Laravel-ready SMPP client
- Reads SMPP config from `.env`
- Clean service-based architecture
- Exception-driven error handling

---

## 📦 Installation

### Step 1: Require the package

```bash
composer require isadma/laravel-smpp
```

### Step 2: Publish the configuration

```bash
php artisan vendor:publish --tag=config
```

---

## ⚙️ Configuration

Add the following to your `.env` file:

```env
SMPP_IP=ip_address
SMPP_PORT=2775
SMPP_FROM=your_short_number
SMPP_USERNAME=your_smpp_username
SMPP_PASSWORD=your_smpp_password
```

The published config file will be available at: `config/smpp.php`.

---

## 💡 Usage

You can use the Facade for cleaner syntax:

```php
use Smpp;

Smpp::sendMessage('9936XXXXXXX', 'Your message');
```

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Credits

- [alexandr-mironov/php-smpp](https://github.com/alexandr-mironov/php-smpp)
