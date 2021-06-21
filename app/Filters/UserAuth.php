<?php
namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use Config\Services;
use Exception;

class UserAuth implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $req, $arguments = null)
    {
		try {
			helper("jwt");
			$tokenInfo = getTokenInfo($req);
		} catch (\Exception $e) {
			return Services::response()->setJSON([
				"error" => "Invalid token."
			]);
		}
		$id_token = $tokenInfo[0];
		$role = $tokenInfo[1];
		$users = new UsersModel();
		$id_user = $users->getUser($req->uri->getSegment(2))["id"];
		if($id_token != $id_user && $role != 10){
			return Services::response()
				->setJSON([
					"error" => " $id_token $id_user You should be the user to update or delete this account"
				]
			);
		}
	}

    public function after(RequestInterface $req,ResponseInterface $res, $arguments = null)
    {
    }
}

