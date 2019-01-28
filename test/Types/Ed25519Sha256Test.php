<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace KryuuCommon\CryptoConditionsTest\Types;

use PHPUnit\Framework\TestCase;
use KryuuCommon\CryptoConditions\Exception\TypeException;
use KryuuCommon\CryptoConditions\Types\Ed25519Sha256;

class Ed25519Sha256Test extends TestCase {
    
    public function testSetSignature() {
        $ed = new Ed25519Sha256();
        
        $ed->setSignature('123456789012345678901234567899012');
    }

    /**
     * @testdox                  When setting public key to a string, expected TypeException should be thrown
     * @expectedException        TypeException
     * @expectedExceptionMessage Public key must be a Buffer, was: string
     */
    public function testSetPublicKeyNotBufferExceptionString() {

        (new Ed25519Sha256())->setPublicKey('Wrong key');
    }

    /**
     * @testdox                  When setting public key to a integer, expected TypeException should be thrown
     * @expectedException        TypeException
     * @expectedExceptionMessage Public key must be a Buffer, was: integer
     */
    public function testSetPublicKeyNotBufferExceptionInteger() {

        (new Ed25519Sha256())->setPublicKey(1);
    }

}