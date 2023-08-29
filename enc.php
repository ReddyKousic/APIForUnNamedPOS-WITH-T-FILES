<?php
// Your encryption key and IV in hexadecimal format



function decrypt($d)
{

    $encryption_key = hex2bin("26a3450f19e7a4dbf0fdfe32418e4b675dd039d6280dd60a8c0abb5509c5e59a");
    $iv = hex2bin("523d931c832f6ac594bd2af8964a1078");

    // The cipher text in binary format
    $cipher_text = hex2bin($d);


    $decrypted_data = openssl_decrypt($cipher_text, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $iv);

    if ($decrypted_data === false) {
        echo "Decryption failed: " . openssl_error_string();
    } else {
        return $decrypted_data;
    }
}
function encrypt($data)
{
    $encryption_key = hex2bin("26a3450f19e7a4dbf0fdfe32418e4b675dd039d6280dd60a8c0abb5509c5e59a");
    $iv = hex2bin("523d931c832f6ac594bd2af8964a1078");

    $cipher_text = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $iv);

    if ($cipher_text === false) {
        echo "Encryption failed: " . openssl_error_string();
    } else {
        return bin2hex($cipher_text);
    }
}
// $y = "0a49e31a40310fda0e2982a08ad5359b93689a463b22768bddc188029ec32d256552be12d55b6a1b5767f09022fe663bdeeb226f4b00c8259d0886de850111f5b44e464f0bad01f47e9575dcdcb483772e1e83a673945207a3f92d3c7af5642dfa321bc0a0dc1dad4a8ad097d13e521fb728db93b2b0c9236527598de039a7157cb53793680331a55e74332876aaf2c8c45bb4c9380f9c65a2ebecbe0266d338ae07d84e992938c1ad3bfd42e6e74f161929811aa4e2bc50ec992d234f77084be5a6cbd1397e19d39743b8ac17e8150ffc2fd58671a64209203480961b07faef";
// $x = decrypt($y);
// echo($x);

?>