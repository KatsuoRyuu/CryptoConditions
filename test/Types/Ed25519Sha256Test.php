<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace KryuuCommon\CryptoConditionsTest\Types;

use KryuuCommon\CryptoConditions\Types\Ed25519Sha256;
use PHPUnit\Framework\TestCase;

class Ed25519Sha256Test extends TestCase {
    
    public function testSetSignature() {
        $ed = new Ed25519Sha256();
        
        $ed->setSignature('123456789012345678901234567899012');
    }
    
}