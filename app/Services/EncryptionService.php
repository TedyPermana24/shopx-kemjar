<?php

namespace App\Services;

class EncryptionService
{
    private string $encryptionKey;
    private string $encryptionMethod = 'AES-256-CBC';

    public function __construct()
    {
        // In a production environment, this key should be stored in a secure KMS
        // For this example, we'll use the Laravel app key
        $this->encryptionKey = substr(config('app.key'), 7);
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