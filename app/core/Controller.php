<?php 


class Controller {

  public function view($view, $data = []) {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($model) {
    require_once '../app/models/' . $model . '.php';
    return new $model;
  }

  public function encryptionDetail() {
    $ciphering = "AES-128-CTR";

    // Using OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '9dj37f8wjr091834';

    // Storing the encryption key
    $encryption_key = "snfjkdsnjkvanljdbfj";

    return array($ciphering, $iv_length, $options, $encryption_iv, $encryption_key);
  }

  public function encrypt($string) {
    list($ciphering, $iv_length, $options, $encryption_iv, $encryption_key) = $this->encryptionDetail();
    $encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryption;
  }

  public function decrypt($string) {
    list($ciphering, $iv_length, $options, $encryption_iv, $encryption_key) = $this->encryptionDetail();
    $decryption = openssl_decrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);

    return $decryption;
  }
  
}