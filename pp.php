<?php
// The key used for encryption (replace this with the actual key)
$key = 'your_generated_key_here';

// The ciphertext you want to decrypt (base64 encoded)
$ciphertextBase64 = 'base64_encoded_ciphertext_here';

// Convert the base64 encoded ciphertext to binary
$ciphertext = base64_decode($ciphertextBase64);

// The initialization vector (IV) used during encryption (16 bytes for AES-256)
$iv = 'your_initialization_vector_here';

// Decrypt the ciphertext using AES-256 in CBC mode
$decryptedData = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

// Convert the decrypted binary data to a string
$decryptedPlaintext = utf8_encode($decryptedData);

echo "Decrypted plaintext: $decryptedPlaintext";
?>
