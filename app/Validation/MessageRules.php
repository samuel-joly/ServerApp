<?php

namespace App\Validation;

use Exception;
use App\Models\MessagesModel;
use App\Models\ReactionsModel;
use Config\Services;

class MessageRules
{
    public function message_exists($str, string $fields, array $data) : bool 
    {
        $message = new MessagesModel();
        $data = $message->getMessages($data["id_message"]);
        if(empty($data))
        {
          return false;
        }else {
          return true;
        }
    }

    public function tag_exists($str, string $fields, array $data) : bool 
    {
      $model = new TagsModel();
      $id_tag = $model->getTags($data["id_tag"]);

			if(empty($id_tag)){
        return false;
      } else {
        return true;
      }
    }
}



