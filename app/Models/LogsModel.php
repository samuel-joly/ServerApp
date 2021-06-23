<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model{
    protected $primaryKey = 'id';
    protected $allowedFields = [
        "hostname",
        "port",
        "size_of_response",
        "request_protocol",
        "error_log_id",
        "request_method",
        "request_status",
        "time_to_respond",
        "request_url",
        "user_agent",
        "age",
        "connection",
        "request_host",
        "date_of_request",
        "request_content_type",
        "request_content_encoding",
        "cors",
        "request_referer",
        "request_accept",
        "request_language",
        "response_encoding",
        "response_content_type",
        "response_keep_alive",
    ];

    public function getLogs($service, $filter = null) {
        $this->table= $service;

        if(is_null($filter)) {
            return $this->findAll();
        }else {
            $query = $this->asArray();
            foreach($filter as $key=>$value) {
                $query->where($key, $value);
            }
            return $query->findAll();
        }

    }

}
