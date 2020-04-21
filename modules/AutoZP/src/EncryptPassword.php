<?php
namespace JingBh\AutoZP;

class EncryptPassword
{
    public function __invoke($password, $validate_code) {
        $key = self::getPublicKey();
        $data = "{$validate_code}:{$password}";
        $encrypt = openssl_public_encrypt($data, $encrypted, $key);
        if ($encrypt) $encrypted = base64_encode($encrypted);
        return $encrypted;
    }

    protected static function getPublicKey() {
        $path = realpath(__DIR__ . "/../keys/password-encrypt.pem");
        return file_get_contents($path);
    }
}
