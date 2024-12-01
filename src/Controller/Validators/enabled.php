<?php

namespace Controller\Validators;


use Smarty\Exception;
use Smarty\Smarty, PDO;
use Validator\statusValidators;

use Validator\Validator;

class enabled
{
    /**
     * @throws Exception
     */
    static function enabled(Smarty $smarty, PDO $db, Validator $validator):never
    {
        statusValidators::enabledValidator($db,$validator);
        $smarty->assign('komunikat','Walidator został <strong>włączony</strong>');
        $smarty->assign('return',true);
        $smarty->display('Validators/delete.tpl');
        exit();
    }
}