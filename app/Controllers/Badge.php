<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\BadgesModel;

class Badge extends BaseController
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
	 * @api {get} /badge Get badges
	 * @apiName index
	 * @apiGroup Badges
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new BadgesModel();

		$data = $model->getBadges();

		if (empty($data)) {
			return $this->respond(["message" => "No badges found"]);
		}
	
		return $this->respond(["message" => "Badges retrieved successfully", "data" => $data]);
	}

	/**
	 * @api {get} /badge/:id Get badge
	 * @apiName show
	 * @apiGroup Badges
	 *
	 * @apiParam {Number} id The badge ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new BadgesModel();
		$data = $model->getBadges($id);

		if(empty($data)) {
			return $this->respond(["message" => "No badges found at id `$id`"], 204);
		}

		return $this->respond(["message" => "Badges retrieved successfully", "data" => $data]);
	}

	/**
	 * @api {put} /admin/badge/:id Update badge
	 * @apiName updateBadge
	 * @apiGroup Admin
	 *
	 * @apiParam {Number} id            The badge ID
	 * @apiParam {String} [name]        The badge's name
	 * @apiParam {String} [description] The badge's description
	 *
	 * @apiUse GenericResponse
	 */
	public function update(int $id)
	{
		try {
			$data = $this->getRequest($this->request);
			$model = new BadgesModel();
			$model->update($id, $data);
			$data = $model->getBadges($id);
			return $this->respond(["message" => "Badge updated successfully", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(["error" => $e->getMessage()]);
		}
	}
	
	/**
	 * @api {delete} /admin/badge/:id Delete badge
	 * @apiName deleteBadge
	 * @apiGroup Admin
	 *
	 * @apiParam {Number} id The badge ID
	 *
	 * @apiUse GenericResponse
	 */
	public function delete(int $id) 
	{
		try {
			$model = new BadgesModel();
			$model->delete(["id" => $id]);
			return $this->respond(["message" => "Badge successfully deleted"]);
		} catch (\Exception $e) {
			return $this->fail(
				[ 
					"error" => "The deletion cannot be made",
				  "message" => $e->getMessage()
				]);
		}
	}
	
	/**
	 * @api {post} /admin/badge Create badge
	 * @apiName createBadge
	 * @apiGroup Admin
	 *
	 * @apiParam {String} name The badge's name
	 * @apiParam {String} description The badge's description
	 * @apiParam {String} image The badge's image path.
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"name" => "required|is_unique[badge.name]",
			"description" => "required",
			'image'	=> 'required',
//			"image" => "max_size[20]|max_dim[50,50]|ext_in[png]",
		];

		$messages = [
			"name" => [
				"required" => "Badge must have a name.",
				"is_unique"=> "Name must be unique."
			],
			"description" => ["required" => "Badge must have a description"],
			"image" => ["required" => "Image must be provided"],
//			"image" => [
//				"required" => "Badge must have an image.",
//				"max_size" => "Image must weight less thant 20Ko.",
//				"max_dim"  => "Image must be less or equal than 50x50",
//				"ext_in"   => "Image must be a PNG"
//			],
		];

		$model = new BadgesModel();
		$data = $this->getRequest($this->request);
		if($this->validateRequest($data, $rules, $messages)) 
		{
			$model->insert($data);
		  $data = $model->where(["name" => "Créé par AdminTest"])->first();

			return $this->respondCreated([
				"message" => "Badge created successfully",
				"data" 		=> $data
			]);
		}
	 	else 
		{
			return $this->fail([
				"message" => $this->request->getFile("image"),
				"error" 	=> $this->validator->getErrors()
			]);
		}
		
	}
}
