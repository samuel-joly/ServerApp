<?php

namespace App\Models;

use CodeIgniter\Api\ResponseTrait;
use CodeIgniter\Model;

class MessagesModel extends Model
{
    use ResponseTrait;
    protected $table = 'message';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'content',
        'id_author',
        'id_topic',
    ];

    public function getMessages($id = null)
    {
        if(is_null($id)) {
            return $this->findAll();
        }

        return $this->asArray()
             ->where(["id" => $id])
             ->first();
    }

    public function getMessagesFromTopic(int $id_topic = null)
    {
        if(is_null($id_topic))
        {
            return [];
        }

        return $this->asArray()
                    ->where(['id_topic' => $id_topic])
                    ->findAll();
    }

}


