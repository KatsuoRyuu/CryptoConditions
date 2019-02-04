<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KryuuCommon\CryptoConditions\Schemas;

use ASN1\Type\Constructed\Sequence;
use ASN1\Type\Primitive\OctetString;
use ASN1\Type\Primitive\Integer;
use ASN1\Type\Tagged\ExplicitlyTaggedType;
use ASN1\Type\Tagged\ImplicitlyTaggedType;
use ASN1\Type\Constructed\Set;
use ASN1\Type\UnspecifiedType;
use ASN1\Type\Structure;
use ASN1\Element;
use ASN1\Type\TaggedType;

/**
 * Description of Fulfullment
 *
 * @author spawn
 */
class Fulfillment
{
    //put your code here

    /**
     *
     * @return Sequence
     */
    public function preImageFulfillment($data)
    {
        $seq = UnspecifiedType::fromDER($data)->asSequence();
        $obj = new stdClass();
        $obj->preimage = $seq->at(0)->asOctetString();
        return $obj;
    }

    /**
     *
     * @return Sequence
     */
    public function prefixFulfillment($data)
    {
        $seq = UnspecifiedType::fromDER($data)->asSequence();
        $obj = new \stdClass();
        $obj->prefix = $seq->at(0)->asOctetString();
        $obj->maxMessageLength = $seq->at(1)->asInteger();
        $obj->subfulfillment = $this->preImageFulfillment($seq->at(2)->toDER());
        return $obj;
    }

    /**
     *
     * @return Sequence
     */
    public function thresholdFulfillment($data)
    {
        $seq = UnspecifiedType::fromDER($data)->asSequence();
        $obj = new \stdClass();
        $obj->subfulfillments = $this->fullfillment($seq->at(0)->asSet()->toDER());
        $obj->subconditions = $seq->at(1)->asSet()->toDER();
        return $obj;
    }

    /**
     *
     * @return Sequence
     */
    public function rsaSha256Fulfillment($data)
    {
        $seq = UnspecifiedType::fromDER($data)->asSequence();
        $obj = new \stdClass();
        $obj->modulus = $seq->at(0)->asOctetString();
        $obj->signature = $seq->at(1)->asOctetString();
        return $obj;
    }

    /**
     *
     * @return Sequence
     */
    public function ed25519Sha256Fulfillment($data)
    { 
        $seq = UnspecifiedType::fromDER($data)->asObjectIdentifier();
        $obj = new \stdClass();
        $obj->publicKey = $seq->at(0)->asOctetString();
        $obj->signature = $seq->at(1)->asOctetString();
        return $obj;
    }

    public function fullfillment($data)
    {
        $seq = TaggedType::fromDER($data)->;
        print_r($seq);
        $obj = new \stdClass();
        $obj->preimageSha256Fulfillment = $this->preImageFulfillment($seq->at(0)->toDER());
        $obj->prefixSha256Fulfillment   = $this->prefixFulfillment($seq->at(1)->toDER());
        $obj->thresholdSha256Fulfillment= $this->thresholdFulfillment($seq->at(2)->toDER());
        $obj->rsaSha256Fulfillment      = $this->rsaSha256Fulfillment($seq->at(3)->toDER());
        $obj->ed25519Sha256Fulfillment  = $this->ed25519Sha256Fulfillment($seq->at(4)->toDER());
    }

    public static function decode($sequence)
    {
        return (new Fulfillment())->fullfillment($sequence);
    }
}
