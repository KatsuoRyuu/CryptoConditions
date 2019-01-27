<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace KryuuCommon\CryptoConditionsTest;

use PHPUnit\Framework\TestCase;


class SupportTest extends TestCase {
    
    
    private $privateKey = "247d3339a3585e9718fba6999b2e741d1abf32caeb3d5d4e038beccb2604234f"
                . "293a165321474a2bcb8eee6281a38d43b583b8d6ed2cfd3c328f689130ca5922";
    private $publicKey  = "293a165321474a2bcb8eee6281a38d43b583b8d6ed2cfd3c328f689130ca5922";
    
    function testLibSodium() {
        $bytes = sodium_crypto_secretbox_keygen();
        $keypair = sodium_crypto_sign_seed_keypair($bytes);
        
        $hex = bin2hex($keypair);
        
        $this->assertEquals(768, strlen($hex)*4);
    }
    
    function testLibSodiumPublicKeyFromSecret() {
        
        $keypair = sodium_crypto_sign_publickey_from_secretkey(hex2bin($this->privateKey));
        
        $this->assertEquals(hex2bin($this->publicKey), $keypair);
        
    }
    
    function testLengthOfKeys() {
        
        $publicKey = sodium_crypto_sign_publickey_from_secretkey(hex2bin($this->privateKey));
        $this->assertEquals(32, strlen($publicKey));
        $this->assertEquals(64, strlen(hex2bin($this->privateKey)));
        
    }
    
    
}
