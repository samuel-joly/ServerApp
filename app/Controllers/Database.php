<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\DatabasesModel;
use App\Models\TablesModel;

class Database extends BaseController {
    use ResponseTrait;
    protected $databases = ["portfolio"];

    public function index() {
        $model = new DatabasesModel();
        $data = $model->getDatabase();
        return $this->respond(["message" => "Database successfully retrieved", "database" => $data]);
    }

    public function getDatabaseTables(){
        $data = $this->getRequest($this->request);
        $database = $data["database"];

        if(!isset($database) ) {
            return $this->respond(["message" => "No database selected"]);
        }

        $model = new TablesModel();
        $data = $model->getTables($database);
        return $this->respond(["message" => "Tables successfully retrieved", "tables" => $data]);
    }

    public function describeTable() {
        $data = $this->getRequest($this->request);
        $database = $data["database"];
        $table = $data["table"];

        if(isset($database) && isset($table)) {
            $model = new TablesModel();
            $data = $model->describeTable($table, $database);
            return $this->respond(["message"=>"table '$table' successfully described", "table" => $data]);
        }
    }

    public function getTableContent() {
        $data = $this->getRequest($this->request);
        $table = $data["table"];
        $database = $data["database"];

        if(isset($database) && isset($table)) {
            $model = new TablesModel();
            $data = $model->getTableContent($table, $database);
            return $this->respond(["message"=>"'$table' content successfully retrieved", "table" => $data]);
        }
    }
}
