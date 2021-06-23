<?php

namespace App\Validation;

use App\Models\UsersModel;
use Exception;

class RegisterRules
{
    public function password_confirm($str, string $fields, array $data) : bool 
    {
        if($data["password"] == $data["passwordConfirm"]) {
            return true;
        } else {
            return false;
        }
    }

    public function password_verify($str, string $fields, array $data) : bool
    {
        try {
            $model = new UsersModel();
            $password = $model->getUserByName($data["username"])["password"];
            return password_verify($data["password"], $password);
        } catch (Exception $e) {
            return false;
        }
    }

}
