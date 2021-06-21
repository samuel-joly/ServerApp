<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class JWTAuth implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $req, $arguments = null)
    {
        $authHeader = $req->getServer('HTTP_AUTHORIZATION');
        try {
            helper("jwt");
            $encodedToken = getJWT($authHeader);
            validateJWT($encodedToken);
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON([
                    "error" => $e->getMessage()
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $req, ResponseInterface $res, $arguments = null)
    {
    }
}

