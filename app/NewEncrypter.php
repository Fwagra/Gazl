<?php

namespace App;

use Illuminate\Encryption\Encrypter;

class NewEncrypter extends Encrypter {

    public function setKey( $key ) {
        $this->key = (string) $key;
    }
}
