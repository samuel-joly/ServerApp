<?php
namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $req, $arguments = null)
    {
        $res->appendHeader('Access-Control-Allow-Origin', "*");
        $res->appendHeader('Access-Control-Allow-Method', "*");
    }

    public function after(RequestInterface $req,ResponseInterface $res, $arguments = null)
    {
    }
}
