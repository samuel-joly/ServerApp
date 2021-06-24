<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\UsersModel;

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
	 * @apiParam {String} [password] The user's new password
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
	 * @apiParam {String} password The new user's password
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"username" => "min_length[3]|max_length[30]",
			"password" => "min_length[6]|max_length[30]",
		];
		
		$messages = [
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

}
