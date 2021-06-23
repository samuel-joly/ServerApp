<?php

use App\Models\UsersModel;
use Config\Services;
use Firebase\JWT\JWT;


function getJWT($req)
{
    if(is_null($req)) {
        throw new Exception('Missing or invalid request token');
    }
    return explode(" ", $req)[1];
}

function validateJWT($encodedToken)
{
    $key = Services::getSecretKey();
    return $key;
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $users = new UsersModel();
    $user = $users->getUserByName($decodedToken->username);
}

function createJWT(string $username)
{
    $createdAt = time();
    $timeToLive = getenv('JWT_TIME_TO_LIVE');
    $expireAt = $createdAt + $timeToLive;
    $payload = [
        'username' => $username,
        'exp'   => $expireAt,
    ];

    return JWT::encode($payload, Services::getSecretKey());
}

function getTokenInfo($req)
{
    $encodedToken = $req->getServer('HTTP_AUTHORIZATION');
    $encodedToken = getJWT($encodedToken);
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $users = new UsersModel();
    $user = $users->getUserByName($decodedToken->username);
    return $user["id"];
}

