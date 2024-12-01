<?php

namespace Verification\Transaction;

use PDO;
use Validator\Validator;
use Verification\Interface\iUpdate;

class update implements iUpdate
{

    static function change(PDO $PDO, string $guid, Validator $validator): void
    {
        $stmt = $PDO->prepare("UPDATE weryfikacja_transakcyjna SET walidator = :name  WHERE guid=:guid");
        $stmt->execute(array(
            'guid'    => $guid,
            'name'    => $validator->getName()
        ));
    }
}