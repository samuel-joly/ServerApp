<?php

namespace App\Models;

use CodeIgniter\Api\ResponseTrait;
use CodeIgniter\Model;

class UsersModel extends Model
{
    use ResponseTrait;
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'password',
    ];

    protected $beforeInsert = ["beforeInsert"];
    protected $beforeUpdate = ["beforeUpdate"];

    public function beforeInsert(array $data)
    {
        return $this->insertWithHashedPassword($data);
    }

    public function beforeUpdate(array $data)
    {
        return $this->insertWithHashedPassword($data);
    }

    public function insertWithHashedPassword(array $data)
    {
        if(isset($data["data"]["password"])) {
            $password = $data["data"]["password"];
            $data["data"]["password"] = password_hash($password, PASSWORD_BCRYPT);
        }
        return $data;
    }
    
    public function getUser($id = null)
    {
        try {
            if(empty($id)) {
                return $this->findAll();
            }
        
            $user = $this->asArray()
                 ->where(["id" => $id])
                 ->first();
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserByName(string $username)
    {
        return $this->asArray()
                    ->where(["username"=>$username])
                    ->first();
    }
}
