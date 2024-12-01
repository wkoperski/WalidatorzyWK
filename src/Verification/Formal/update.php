<?php

namespace Verification\Formal;

use PDO;
use Validator\Validator;
use Verification\Interface\iUpdate;

class update implements iUpdate
{
    /**
     * @param PDO $PDO
     * @param string $guid <p>
     *     GUID weryfikacji formalnej do zaktualizowania
     * </p>
     * @param Validator $validator
     * @return void
     */
    static function change(PDO $PDO, string $guid, Validator $validator): void
    {
        $stmt = $PDO->prepare("UPDATE weryfikacja_formalna SET walidator = :name  WHERE guid=:guid");
        $stmt->execute(array(
            'guid'    => $guid,
            'name'    => $validator->getName()
        ));
    }
};

$PDO = new PDO("mysql:host=localhost;dbname=wedo", "root", "root");
try {
    $validator = Validator::getValidatorByName($PDO, 'Wojciech Koperski');
    update::change($PDO, '123', $validator);
} catch (\Exception $e) {
    echo 'Failure update Formal Verification';
}
