<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;
use App\Models\UserBadgesModel;

class User extends BaseController
{
	use ResponseTrait;

	/**
	 * @apiDefine GenericResponse
	 *
	 * @apiSuccess {String} [message] The message returned
	 * @apiSuccess {Object} [data]    The data
	 *
	 */

	/**
	 * @api {get} /user Get users
	 * @apiName index
	 * @apiGroup Users
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new UsersModel();
		$data = $model->getUser();

		if(empty($data))
		{
			return $this->respond(["message" => "No users found"]);
		}

		return $this->respond(["message" => "User successfully retrieved", "data" => $data]);
	}

	/**
	 * @api {get} /user/:id Get user
	 * @apiName show
	 * @apiGroup Users
	 *
	 * @apiParam {Number} id The user ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new UsersModel();
		$data = $model->getUser($id);

		if(empty($data)) {
			return $this->respond("No users found at id `$id`", 204);
		}

		return $this->respond([
			"message" => "User data successfuly retrieved",
			"data" => $data
		]);
	}

	/**
	 * @api {put} /user/:id Update user
	 * @apiName update
	 * @apiGroup Users
	 *
	 * @apiParam {Number} id         The user ID
	 * @apiParam {String} [username] The user's new name
	 * @apiParam {String} [email]    The user's new e-mail
	 * @apiParam {String} [password] The user's new password
	 * @apiParam {String} [avatar]   The user's new avatar
	 *
	 * @apiUse GenericResponse
	 */
	public function update(int $id)
	{
		try {
			$model = new UsersModel();
			$data = $this->getRequest($this->request);
			$model->update($id, $data);
			$data = $model->getUser($id);
			return $this->respond(["message" => "Account successfully updated", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(["error" => $e->getMessage()]);
		}
	}
	
	/**
	 * @api {delete} /user/:id Delete user
	 * @apiName delete
	 * @apiGroup Users
	 *
	 * @apiParam {Number} id        The user ID
	 *
	 * @apiUse GenericResponse
	 */
	public function delete(int $id) 
	{
		try {
			$model = new UsersModel();
			$model->delete(["id" => $id]);
			return $this->respond(["message" => "Account successfully deleted"]);
		} catch (\Exception $e) {
			return $this->fail(
				[ 
					"error" => "The deletion cannot be made",
				  "message" => $e->getMessage()
				]);
		}
	}

	/**
	 * @api {post} /admin/user/ Create user
	 * @apiName createUser
	 * @apiGroup Admin
	 *
	 * @apiParam {String} username The new user's name
	 * @apiParam {String} email    The new user's e-mail
	 * @apiParam {String} password The new user's password
	 * @apiParam {String} [avatar] The new user's avatar
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"email"    => "valid_email|min_length[6]|max_length[50]|is_unique[user.email]",
			"username" => "min_length[3]|max_length[30]",
			"password" => "min_length[6]|max_length[30]",
		];
		
		$messages = [
			"email"	=> "6 < size < 50, email should be unique, email should be valid",
			"username" => "3 < size < 30"
		];

		$model = new UsersModel();
		$data = $this->getRequest($this->request);

		if ($this->validateRequest($data, $rules, $messages)) {
			$model->insert($data);
		} else {
			return $this->fail([
				"message" => "Wrong inputs given",
				"errors" 	=> $this->validator->getErrors()
			]);
		}
		$data = $model->where(["username"=> $data["username"]])->first();
		return $this->respondCreated([
			"message" => "User created successfully",
			"data" 		=> $data
		]);
	}

	/**
	 * @api {post} /user/:id/badges Get user badges
	 * @apiName getUserBadges
	 * @apiGroup Users
	 *
	 * @apiParam {Number} id        The user ID
	 *
	 * @apiUse GenericResponse
	 */
	public function getUserBadges(int $id_user)
	{
		$model = new UserBadgesModel();
		$data = $model->getBadgesFromUser($id_user);
		return $this->respond([
			"message"	=> "Badges successfully retrieved",
			"data"		=> $data
		]);
	}
}
