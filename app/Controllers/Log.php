<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\LogsModel;

class Log extends BaseController {
    /**
     * @apiDefine GenericResponse
     *
     * @apiSuccess {String} [message] The endpoint return value
     * @apiSuccess {Object} [logs]    The logs returned
     *
     */

    use ResponseTrait;

    /**
     * @api {get} /log Get logs
     * @apiName index
     * @apiGroup Log
     * @apiParam {Object} [filter] A json object with filter as { response_status : 200 , hostname : "125.168.1.26"}
     * @apiParam {Int} [limit] The number of returned logs, return all logs if 0
     * @apiParam {String} [service] The name of the requested service's logs
     *
     * @apiUse GenericResponse
     */
    public function index() {
        $model = new LogsModel();
        $data = $this->getRequest($this->request);

        $logs = $model->getLogs($data["service"] ?? "portfolio_log", $data["filter"] ?? null, $data["limit"] ?? 50);
        return $this->respond($logs);

        if(empty($logs)) {
            return $this->respond(['message' => 'No logs available']);
        }

        return $this->respond([
            'message'   => 'Logs successfully retrieved',
            'logs'      => $logs
        ]);
    }


    public function stats() {
        $model = new LogsModel();
        $data = $this->getRequest($this->request);

        switch($data["type"]) {
            case "visit":
                    $logs = $model->countLogsBasedOnIP($data["service"]);
                break;
            case "error":
                    $logs = $model->countErrorLogs($data["service"]);
                    return $this->respond(["message" => "Data successfully retrieved", "data" => $logs]);
                break;
        }

        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $retLog = [0,0,0,0,0,0,0,0,0,0,0,0];
        for($i=0; $i < count($months); $i++) {
            if(get_object_vars($logs[$i])["DATE_FORMAT(from_unixtime(date_of_request), '%M')"] == $months[$i]) {
                $retLog[$i] = get_object_vars($logs[$i])["count(hostname)"];
            }
            return $this->respond(["message" => "Data successfully retrieved", "data" => $retLog]);
        }
    }

}
