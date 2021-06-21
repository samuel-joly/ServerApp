<?php

namespace App\Models;

use CodeIgniter\Api\ResponseTrait;
use CodeIgniter\Model;

class TopicsModel extends Model
{
    use ResponseTrait;
    protected $table = 'topic';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'subject',
        'id_author',
        'id_category',
        'id_answer'
    ];

    public function getTopics($id = null)
    {
        if(empty($id)) {
            return $this->findAll();
        }

        return $this->asArray()
             ->where(["id" => $id])
             ->first();
    }

}

