<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
	use ResponseTrait;

	/**
	 * @apiDefine LoginResponse
	 *
	 * @apiSuccess {String} message The message returned
	 * @apiSuccess {Object} user    The user data
	 * @apiSuccess {String} token   The JWT token for authentication
	 *
	 */

	/**
	 * @api {post} /auth/register Register new user
	 * @apiName register
	 * @apiGroup Authentification
	 *
	 * @apiParam {String} username        The new user's name
	 * @apiParam {String} password        The new user's password
	 * @apiParam {String} passwordConfirm The new user's password confirmation
	 *
	 * @apiUse LoginResponse
	 */
	public function register()
	{
		$rules = [
			"username"        => "min_length[3]|max_length[30]|is_unique[user.username]",
			"password"        => "min_length[6]|max_length[30]",
			"passwordConfirm" => "min_length[6]|max_length[30]|password_confirm[user.password,user.passwordConfirm]",
		];
		$input = $this->getRequest($this->request);
		if (!$this->validateRequest($input, $rules)) {
			return $this->fail(["errors" => $this->validator->getErrors()]);
		}

		$model = new UsersModel();
		$model->save($input);

		return $this->getJWTForUser($input["username"]);
	}

	/**
	 * @api {post} /auth Authenticate user
	 * @apiName login
	 * @apiGroup Authentification
	 *
	 * @apiParam {String} email           The new user's e-mail
	 * @apiParam {String} password        The new user's password
	 *
	 * @apiUse LoginResponse
	 *
	 */
	public function login()
	{
		$rules = [
			"username" => "required|min_length[3]|max_length[50]",
			"password" => "required|min_length[6]|max_length[30]|password_verify[user.password,user.username]",
		];

		$errors = [
			"username" => "Invalid login credentials",
			"password" => ["password_verify" => "Invalid password"]
		];

		$input = $this->getRequest($this->request);

		if (!$this->validateRequest($input, $rules, $errors)) {
			return $this->fail(
				[
					"errors" => [
						$this->validator->getErrors(),
						$input
					]
				]
			);
		}

		return $this->getJWTForUser($input["username"]);
	}

	public function getJWTForUser($username)
	{
		helper("jwt");
		try {
			$model = new UsersModel();
			$user = $model->getUserByName($username);
			unset($user["password"]);

			return $this->respond([
				"message" => "Access granted",
				"user"		=> $user,
				"token"		=> createJWT($username)
			]);
		} catch (\Exception $e) {
			return $this->fail(
				[
					"message" => "Something went wrong",
					"error" => $e->getMessage()
				]
			);
		}
	}
}
