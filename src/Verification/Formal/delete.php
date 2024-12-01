<?php

namespace Verification\Formal;

use PDO;

class delete
{
    static function delete(PDO $PDO, string $guid):void
    {

        $stmt = $PDO->prepare("DELETE FROM weryfikacja_formalna WHERE id=:id");
        $stmt->execute(array(
            'id'    => $guid
        ));


    }
}