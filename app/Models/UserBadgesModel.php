<?php

namespace App\Models;

use CodeIgniter\Model;

class UserBadgesModel extends Model
{
    protected $table = "user_badge"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_user',
        'id_badge',
    ];
    public function getBadgesFromUser($id_user)
    {
        return $this->select('id_badge')
                    ->where(["id_user" => $id_user])
                    ->findAll();
    }
}

