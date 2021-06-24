<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\DatabasesModel;
use App\Models\TablesModel;

class Database extends BaseController {
    /**
     * @apiDefine GenericResponse
     *
     * @apiSuccess {String} [message] The endpoint return value
     * @apiSuccess {Object} [data]    The returned database data
     *
     */
    use ResponseTrait;
    protected $databases = ["portfolio"];


    /**
     * @api {get} /database Get Databases
     * @apiName index
     * @apiGroup Database
     *
     * @apiUse GenericResponse
     */
    public function index() {
        $model = new DatabasesModel();
        $data = $model->getDatabase();
        return $this->respond(["message" => "Database successfully retrieved", "database" => $data]);
    }

    /**
     * @api {get} /database/tables Get tables from database
     * @apiName index
     * @apiGroup Database
     *
     * @apiParam {String} database name
     *
     * @apiUse GenericResponse
     */
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

    /**
     * @api {get} /database/describe Get tables infos from database
     * @apiName index
     * @apiGroup Database
     *
     * @apiParam {String} database name
     * @apiParam {String} table name
     *
     * @apiUse GenericResponse
     */
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


     /*
     * @api {get} /database/table/content Get tables content from database
     * @apiName index
     * @apiGroup Database
     *
     * @apiParam {String} database name
     * @apiParam {String} table name
     *
     * @apiUse GenericResponse
     */
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
