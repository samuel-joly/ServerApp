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

    public function getLogs($service, $filter = null, $limit=50) {
        $this->table= $service;

        if(is_null($filter)) {
            if($limit != 0) {
                return $this->limit($limit)->find();
            } else {
                return $this->findAll();
            }
        }else {
            $query = $this->asArray();
            foreach($filter as $key=>$value) {
                $query->where($key, $value);
            }
            return $query->limit($limit)->find();
        }

    }

    public function countLogsBasedOnIP($service) {
        $this->table = $service;
        $logs = $this->query("select count(hostname), DATE_FORMAT(from_unixtime(date_of_request), '%M') from $service where request_url='GET / HTTP/1.1' group by
DATE_FORMAT(from_unixtime(date_of_request), '%M')")->getResult();
        return $logs;
    }

    public function countErrorLogs($service) {
        $this->table = $service;
        $logs = $this->query("select count(hostname), DATE_FORMAT(from_unixtime(date_of_request), '%M') from $service where request_status = 404 OR request_status = 400 AND request_url != 'GET /favicon.ico HTTP/1.1' group by DATE_FORMAT(from_unixtime(date_of_request), '%M')")->getResult();
        return $logs;
    }

    public function getUserAgent($service, $browser) {
        $this->table = $service;
        switch($browser) {
            case "Firefox":
                    $logs = $this->query("select count(user_agent) from portfolio_log where request_url = 'GET / HTTP/1.1' and user_agent REGEXP '.+(Linux|Window|Macintosh|Iphone).+Firefox.?'")->getResult();
                break;

            case "Chrome":
                $logs = $this->query("select count(user_agent) from portfolio_log where request_url = 'GET / HTTP/1.1' and user_agent REGEXP '.+(Linux|Window|Macintosh|Iphone).+Chrome.?'")->getResult();
                break;

            case "Safari":
                    $logs = $this->query("select count(user_agent) from portfolio_log where request_url = 'GET / HTTP/1.1' and user_agent REGEXP '.+(Macintosh|Iphone).+Safari.?'")->getResult();
                break;

            case "Edge":
                $logs = $this->query("select count(user_agent) from portfolio_log where request_url = 'GET / HTTP/1.1' and user_agent REGEXP '.+(Linux|Window|Macintosh|Iphone).+Edge.?'")->getResult();
                break;

            default :
                $logs = $this->query("select user_agent, count(user_agent) from portfolio_log where request_url = 'GET / HTTP/1.1' and user_agent REGEXP 'Mozilla/5.0\((\d+)?(Linux|Window|Macintosh|Iphone)\).+(Edge|Chrome|Safari|Firefox).?' group by user_agent REGEXP 'Mozilla/5.0\((\d+)?(Linux|Window|Macintosh|Iphone)\).+(Edge|Chrome|Safari|Firefox).?'")->getResult();
                break;
        }
        return $logs;
    }

}
