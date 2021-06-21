<?php

namespace App\Models;

use CodeIgniter\Model;

class BadgesModel extends Model
{
    protected $table = "badge"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'name',
        'description',
        'image'
    ];
    public function getBadges($id = false)
    {
        if($id == false) {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(["id" => $id])
                    ->first();
    }
    
}
