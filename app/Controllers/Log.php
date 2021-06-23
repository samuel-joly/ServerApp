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
     * @apiGroup log
     *
     * @apiUse GenericResponse
     */
    public function index() {
        $model = new LogsModel();
        $data = $this->getRequest($this->request);

        $logs = $model->getLogs($data["service"] ?? "portfolio_log", $data["filter"] ?? null);
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
