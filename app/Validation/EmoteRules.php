<?php

namespace App\Validation;

use Exception;
use App\Models\EmotesModel;

class EmoteRules
{
    public function emote_exists($str, string $fields, array $data) : bool 
    {
        $message = new EmotesModel();
        if(!empty($message->getEmotes($data["id_emote"])))
        {
          return true;
        } else {
          return false;
        }   
    }


}



