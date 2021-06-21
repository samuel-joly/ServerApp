<?php
namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AdminAuth implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $req, $arguments = null)
    {
			try {
				helper('jwt');
				$tokenInfo = getTokenInfo($req);
			} catch (\Exception $e) {
				return Services::response()->setJSON([
					"error" => "Invalid token."
				]);
			}
			
			$role = $tokenInfo[1];
			if ($role != 10){
					return Services::response()
						->setJSON([
							"error" => "You do not have the permission"
						]
					);
			}
    }

    public function after(RequestInterface $req,ResponseInterface $res, $arguments = null)
    {
    }
}


