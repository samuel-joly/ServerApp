<?php

namespace App\Validation;

use App\Models\ReactionsModel;

class ReactionRules
{
    public function reactionExists($str, string $fields, array $data) : bool 
    {
        $message = new ReactionsModel();
        $data = $message->getReactions($data["id_reaction"]);     
        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }


}


