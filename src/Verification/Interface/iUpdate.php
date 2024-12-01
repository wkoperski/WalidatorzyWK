<?php

namespace Verification\Interface;

use PDO;
use Validator\Validator;


interface iUpdate
{
    static function change(PDO $PDO,string $guid, Validator $validator):void;
}