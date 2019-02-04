<?php

namespace KryuuCommon\CryptoConditions\Util;

/**
 * Utility class for encoding and decoding Base64Url.
 */
class Base64Url
{
    /**
    * Convert a base64url encoded string to a Buffer.
    *
    * @param {String} base64urlString base64url-encoded string
    * @return {Buffer} Decoded data.
    */
    public static function decode($base64urlString)
    {
            return base64_decode(
                str_replace(
                    '-',
                    '+',
                    str_replace('_', '/', $base64urlString)
                )
            );
    }

    /**
    * Encode a buffer as base64url.
    *
    * @param {Buffer} buffer Data to encode.
    * @return {String} base64url-encoded data.
    */
    public static function encode($buffer)
    {
        return base64_encode(
            str_replace(
                '=',
                '',
                str_replace(
                    '+',
                    '-',
                    str_replace('/', '_', $string)
                )
            )
        );
    }
}
