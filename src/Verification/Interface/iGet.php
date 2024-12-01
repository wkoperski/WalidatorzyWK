<?php

namespace Verification\Interface;

use Validator\Validator,Verification\Formal\VerificationStatus,PDO;


interface iGet
{
    static function byName(PDO $PDO, Validator $validator,VerificationStatus $status = null):array;
}