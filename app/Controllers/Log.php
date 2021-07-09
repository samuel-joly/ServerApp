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

}
