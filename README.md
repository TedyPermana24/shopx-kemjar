# ShopX E-Commerce Website

ShopX is an e-commerce website built with Laravel 12 that focuses on data security using AES-256 encryption for sensitive user information.

## Features

- User authentication and profile management
- Product browsing and searching
- Shopping cart functionality
- Secure payment method management
- Order processing and history
- AES-256 encryption for sensitive data

## Security Implementation

This application implements AES-256 encryption for the following sensitive data:

- User personal information (phone, address)
- Payment information (card number, card holder, expiry date, CVV)

The encryption is handled by the `EncryptionService` class, which ensures that sensitive data is encrypted before being stored in the database and decrypted only when needed.

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL or compatible database
- Node.js and NPM (for frontend assets)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/shopx.git
cd shopx
```
