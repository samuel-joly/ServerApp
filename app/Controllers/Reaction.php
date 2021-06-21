<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ReactionsModel;

class Reaction extends BaseController
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
	 * @api {get} /reaction Get reactions
	 * @apiName index
	 * @apiGroup Reactions
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new ReactionsModel();
		$data = $model->getReaction();

		if(empty($data))
		{
			return $this->respond(["message" => "No Reaction found"]);
		}

		return $this->respond(["message" => "Reaction successfully retrieved", "data" => $data]);
	}

	/**
	 * @api {get} /reaction/:id Get reaction
	 * @apiName show
	 * @apiGroup Reactions
	 *
	 * @apiParam {Number} id The reaction ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new ReactionsModel();
		$data = $model->getReactions($id);

		if(empty($data)) {
			return $this->respond("No reaction found at id `$id`", 204);
		}

		return $this->respond(["data" => $data]);
	}

	public function update(int $id)
	{
		try {
			$model = new ReactionsModel();
			$data = $this->getRequest($this->request);
			$model->update($id, $data);
			$data = $model->getReactions($id);
			return $this->respond(["message" => "Reaction successfully updated", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail($e->getMessage());
		}
	}

	/**
	 * @api {post} /reaction/:id Create reaction
	 * @apiName create
	 * @apiGroup Reactions
	 *
	 * @apiParam {Number} id The message ID to react to
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"id_message" => "message_exists[reaction.id_message]",
		];
		
		$messages = [
			"id_message" => "Message should exist",
		];

		$model = new ReactionsModel();
		$data = $this->getRequest($this->request);

		if ($this->validateRequest($data, $rules, $messages)) {
			helper("jwt");
			$data["id_user"] = getTokenInfo($this->request)[0];
			$model->insert($data);
		} else {
			return $this->fail([
				"message" => "Wrong inputs given",
				"errors" 	=> $this->validator->getErrors()
			]);
		}
		
		return $this->respondCreated([
			"message" => "Reaction created successfully",
			"data" 		=> $data
		]);
	}
}
