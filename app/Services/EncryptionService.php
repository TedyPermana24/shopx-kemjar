<?php

namespace App\Services;
use RuntimeException;


class EncryptionService
{
    private string $encryptionKey;
    private string $encryptionMethod = 'AES-256-CBC';

    public function __construct()
    {
        // Path ke file kunci di OneDrive
        $keyPath = 'C:\Users\ppfat\OneDrive\KEY KEMJAR\key.txt';

        if (!file_exists($keyPath)) {
            throw new RuntimeException("Encryption key file not found at: $keyPath");
        }

        $key = trim(file_get_contents($keyPath));

        if (strlen($key) < 32) {
            throw new RuntimeException("Encryption key must be at least 32 characters for AES-256.");
        }

        // Simpan 32 karakter pertama sebagai kunci (AES-256 butuh 32-byte key)
        $this->encryptionKey = substr($key, 0, 32);
       
    }

    public function encrypt(string $data): string
    {
        $ivLength = openssl_cipher_iv_length($this->encryptionMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);
        
        $encrypted = openssl_encrypt(
            $data,
            $this->encryptionMethod,
            $this->encryptionKey,
            OPENSSL_RAW_DATA,
            $iv
        );
        
        // Return IV + encrypted data encoded in base64
        return base64_encode($iv . $encrypted);
    }

    public function decrypt(string $data): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length($this->encryptionMethod);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        
        return openssl_decrypt(
            $encrypted,
            $this->encryptionMethod,
            $this->encryptionKey,
            OPENSSL_RAW_DATA,
            $iv
        );
    }
}