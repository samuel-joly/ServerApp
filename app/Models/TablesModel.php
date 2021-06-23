<?php

namespace App\Models;

use CodeIgniter\Model;

class TablesModel extends Model{
    protected  $custom = [
    'DSN'      => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => '',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => (ENVIRONMENT !== 'production'),
    'charset'  => 'utf8',
    'DBCollat' => 'utf8_general_ci',
    'swapPre'  => '',
    'encrypt'  => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port'     => 3306,
];

    public function getTables($database) {
        if(!isset($database)) {
            return null;
        }
        $this->custom["database"] = $database;
        $db = \Config\Database::connect($this->custom);

        return $db->listTables();
    }

    public function describeTable($table, $database) {
        if(!isset($table)|| !isset($database)) {
            return null;
        }

        $this->custom["database"] = $database;
        $db = \Config\Database::connect($this->custom);

        return $db->getFieldData($table);
    }

    public function getTableContent($table, $database) {

        if(!isset($table) || !isset($database)) {
            return null;
        }
        $this->table = $table;
        $this->custom["database"] = $database;
        $db = \Config\Database::connect($this->custom);

        return $db->query("Select * from $table")->getResult();
    }
}
