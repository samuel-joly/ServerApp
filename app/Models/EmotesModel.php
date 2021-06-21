<?php

namespace App\Models;

use CodeIgniter\Model;

class EmotesModel extends Model
{
    protected $table = "emote"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'name',
        'markup_name',
        'image'
    ];

    public function getEmotes($id = false)
    {
        if($id == false) {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(["id" => $id])
                    ->first();
    }
    
}
