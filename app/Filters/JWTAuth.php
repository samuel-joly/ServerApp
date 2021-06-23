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
            Services::response()
                ->setJSON([
                    "response" => validateJWT($encodedToken)
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);

        } catch (\Exception $e) {
            return Services::response()
                ->setJSON([
                    "error" => validateJWT($encodedToken)
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $req, ResponseInterface $res, $arguments = null)
    {
    }
}

