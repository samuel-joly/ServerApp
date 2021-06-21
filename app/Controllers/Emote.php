<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\EmotesModel;

class Emote extends BaseController
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
	 * @api {get} /emote Get emotes
	 * @apiName index
	 * @apiGroup Emotes
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new EmotesModel();
		$data = $model->getEmotes();

		if(empty($data))
		{
			return $this->respond(["message" => "No emote found"]);
		}

		return $this->respond(["message" => "Emote successfully retrieved", "data" => $data]);
	}
	
	/**
	 * @api {get} /emote/:id Get emote
	 * @apiName show
	 * @apiGroup Emotes
	 *
	 * @apiParam {Number} id The emote ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new EmotesModel();
		$data = $model->getEmotes($id);

		if(empty($data)) {
			return $this->respond(["message" => "No emote found at id `$id`"], 204);
		}

		return $this->respond([
			"message" => "Emote successfully retrieved",
			"data" => $data
		]);
	}
	
	/**
	 * @api {put} /admin/emote/:id Update emote
	 * @apiName updateEmote
	 * @apiGroup Admin
	 *
	 * @apiParam {Number} id            The emote ID
	 * @apiParam {String} [name]        The emote's nice name
	 * @apiParam {String} [markup_name] The emote's identifier used for markup parsing
	 * @apiParam {String} [image]       The image displayed when using the emote
	 *
	 * @apiUse GenericResponse
	 */
	public function update(int $id)
	{
		try {
			$model = new EmotesModel();
			$data = $this->getRequest($this->request);
			$model->update($id, $data);
			$data = $model->getEmotes($id);
			return $this->respond(["message" => "Emote successfully updated", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(
				[ 
					"message" => "The update cannot be made",
					"error" => $e->getMessage()
				]);
		}
	}
	
	/**
	 * @api {delete} /admin/emote/:id Delete emote
	 * @apiName deleteEmote
	 * @apiGroup Admin
	 *
	 * @apiParam {Number} id            The emote ID
	 *
	 * @apiUse GenericResponse
	 */
	public function delete(int $id) 
	{
		try {
			$model = new EmotesModel();
			$user = $model->getEmotes($id);
			$model->delete(['id'=>$id]);
			return $this->respond(["message" => "Emote successfully deleted", "deleted emote" => $user]);
		} catch (\Exception $e) {
			return $this->fail(
				[ "error" => "The deletion cannot be made",
				  "message" => $e->getMessage()
				]);
		}
	}
	
	/**
	 * @api {post} /admin/emote/:id Create emote
	 * @apiName createEmote
	 * @apiGroup Admin
	 *
	 * @apiParam {String} name        The emote's nice name
	 * @apiParam {String} markup_name The emote's identifier used for markup parsing
	 * @apiParam {String} image       The image displayed when using the emote
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"name" => "required|is_unique[badge.name]",
			"markup_name" => "required",
			"image"		=> "required",
//			"image" => "max_size[40]|max_dim[150,150]|ext_in[png]",
		];

		$messages = [
			"name" => [
				"required" => "Emote must have a name.",
				"is_unique"=> "Name must be unique."
			],
			"markup_name" => ["required" => "Emote must have a description."],
			"image" => ["required" => "Image requise TEST"],
//			"image" => [
//				"required" => "Emote must have an image.",
//				"max_size" => "Image must weight less thant 40Ko.",
//				"max_dim"  => "Image must be less or equal than 150x150",
//				"ext_in"   => "Image must be a PNG"
//			],
		];
		$model = new EmotesModel();
		$data = $this->getRequest($this->request);

		if($this->validateRequest($data, $rules, $messages)) 
		{
			$model->insert($data);
		}
	 	else 
		{
			return $this->fail([
				"message" => "Wrong inputs given",
				"error" 	=> $this->validator->getErrors()
			]);
		}
		
		return $this->respondCreated([
			"message" => "Emote created successfully",
			"data" 		=> $data
		]);
	}

}
