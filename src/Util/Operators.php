<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace KryuuCommon\CryptoConditions\Util;

use KryuuCommon\Buffer;

class Operators
{

    public function oXor($a, $b)
    {
        if (! Buffer::isBuffer($a) || ! Buffer::isBuffer($b)) {
            throw new \Exception('Arguments must be buffers');
        }

        if ($a->length() !== $b->length()) {
            throw new \Exception('Buffers must be the same length');
        }
        $result = Buffer::alloc($a->length);
        for ($i = 0; $i < $a->length; $i++) {
            $result[$i] = $a[$i] ^ $b[$i];
        }
        return $result;
    }
}
