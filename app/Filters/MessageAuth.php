<?php
namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MessagesModel;
use Config\Services;
use Exception;

class MessageAuth implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $req, $arguments = null)
    {
			helper("jwt");
			$id_user = getTokenInfo($req)[0];
			$role = getTokenInfo($req)[1];
			$model = new MessagesModel();
			$id_author = $model->getMessages($req->uri->getSegment(2));

			if ($id_author != $id_user && $role != 10){
					return Services::response()->setStatusCode(404)
						->setJSON([
							"error" => "You should be the author to update/delete this content"
						]);
			}
    }

    public function after(RequestInterface $req,ResponseInterface $res, $arguments = null)
    {
    }
}

