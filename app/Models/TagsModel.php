<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TopicTags;

class TagsModel extends Model
{
    protected $table = "tag"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'name',
    ];
    public function getTags($id = false)
    {
        if($id == false) {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(["id" => $id])
                    ->first();
    }

    
}

