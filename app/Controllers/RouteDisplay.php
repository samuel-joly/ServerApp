<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class RouteDisplay extends BaseController 
{

	use ResponseTrait;

	public function getRoutes()
	{
		$router = Services::routes();
		return $this->respond(["message"=>"Routes successfully retrieved", "routes"=>$router->getRoutes()]);
	}
}
