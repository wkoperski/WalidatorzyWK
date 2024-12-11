<?php

namespace Verification;

use PDO;
class getFormalVerification
{


    static public function getFormalVerificationByGUID(PDO $PDO,string $guid) : array
    {
        $stmt = $PDO->prepare("SELECT * FROM weryfikacja_formalna where guid = ?");
        $stmt->execute(array($guid));

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}