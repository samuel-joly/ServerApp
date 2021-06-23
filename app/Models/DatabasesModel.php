<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabasesModel extends Model{
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "database_name",
    ];
    protected $table = 'database';


    public function getDatabase() {
        return $this->asArray()
            ->findAll();
    }
}
