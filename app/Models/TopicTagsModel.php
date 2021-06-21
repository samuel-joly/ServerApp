<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TopicTags;

class TopicTagsModel extends Model
{
    protected $table = "topic_tag"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_tag',
        'id_topic',
    ];

    public function getTopicTags(int $id_topic = null)
    {
        if(is_null($id_topic))
        {
            return $this->findAll();
        }

        return $this->asArray()->where(['id_topic'=>$id_topic])->first();
    }

    public function getTagsFromTopic(int $id_topic = null)
    {
        if(is_null($id_topic))
        {
            return [];
        }
        
        return $this->select('id_tag')
                    ->where(["id_topic"=>$id_topic])
                    ->findAll();
        
    }

    public function isTagInTopic(int $id_tag=null, int $id_topic=null)
    {
        if(is_null($id_tag) || is_null($id_topic))
        {
            return [];
        }

        $data = $this->asArray()
                     ->where(["id_topic"=>$id_topic, "id_tag" => $id_tag])
                     ->first();
        if(empty($data))
        {
           return false; 
        }
        return true;
    }

}


