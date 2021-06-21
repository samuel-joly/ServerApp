<?php

namespace App\Models;

use CodeIgniter\Model;

class ReactionsModel extends Model
{
    protected $table = "reaction"; 
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'id_user',
        'id_emote',
        'id_message'
    ];

    public function getReaction($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(["id" => $id])
                    ->first();
    }

    public function getReactionsFromMessage(int $id_message = null)
    {
        if (is_null($id_message)) {
            return [];
        }

        return $this->asArray()
                    ->where(["id_message" => $id_message])
                    ->findAll();
    }

    public function reactionExists(int $id_user = null, int $id_emote = null)
    {
        if (is_null($id_user) || is_null($id_emote)) {
            return [];
        }

        $data = $this->asArray()
                     ->where(["id_user" => $id_user, "id_emote" => $id_emote])
                     ->findAll();
        
        if (empty($data)) {
            return false;
        }
        
        return true;
    }
}
