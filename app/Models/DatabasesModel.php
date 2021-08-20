<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabasesModel extends Model{
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "database_name",
    ];
    protected $table = 'web_app';


    public function getDatabase() {
        return $this->asArray()
            ->findAll();
    }
}
