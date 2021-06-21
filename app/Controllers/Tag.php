<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\TagsModel;

class Tag extends BaseController
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
	 * @api {get} /tag Get tags
	 * @apiName index
	 * @apiGroup Tags
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new TagsModel();
		$data = $model->getTags();

		if (empty($data)) {
			return $this->respond(["message" => "No tags found"]);
		}

		return $this->respond(["message" => "Tags retrieved successfully", "data" => $data]);
	}
	
	/**
	 * @api {get} /tag/:id Get tag
	 * @apiName show
	 * @apiGroup Tags
	 *
	 * @apiParam {Number} id The tag ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new TagsModel();
		$data = $model->getTags($id);

		if (empty($data)) {
			return $this->respond(["message" => "No tags found at id `$id`"], 204);
		}

		return $this->respond(["message" => "Tags retrieved successfully", "data" => $data]);
	}

	public function update(int $id)
	{
		try {
			$data = $this->getRequest($this->request);
			$model = new TagsModel();
			$model->update($id, $data);
			$data = $model->getTags($id);
			return $this->respond(["message" => "Tag updated successfully", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(["error" => $e->getMessage()]);
		}
	}

	public function delete(int $id)
	{
		try {
			$model = new TagsModel();
			$model->delete(["id" => $id]);
			return $this->respond(["message" => "Tag successfully deleted"]);
		} catch (\Exception $e) {
			return $this->fail(
				[
					"error" => "The deletion cannot be made",
					"message" => $e->getMessage()
				]
			);
		}
	}

	/**
	 * @api {get} /tag Create tag
	 * @apiName create
	 * @apiGroup Tags
	 *
	 * @apiParam {String} name The tag name
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"name" => "required|is_unique[tag.name]",
		];

		$messages = [
			"name" => [
				"required"  => "Tag must have a name.",
				"is_unique" => "Name must be unique."
			],
		];

		$model = new TagsModel();
		$data = $this->getRequest($this->request);
		if ($this->validateRequest($data, $rules, $messages)) {
			$model->insert($data);

			return $this->respondCreated([
				"message" => "Tag created successfully",
				"data" 		=> $data
			]);
		} else {
			return $this->fail([
				"errors" 	=> $this->validator->getErrors()
			]);
		}
	}
}
