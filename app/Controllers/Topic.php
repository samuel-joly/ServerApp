<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\TopicsModel;
use App\Models\MessagesModel;

class Topic extends BaseController
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
	 * @api {get} /topic Get topics
	 * @apiName index
	 * @apiGroup Topics
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new TopicsModel();
		$data = $model->getTopics();

		if (empty($data))
		{
			return $this->respond(["message" => "No topic found"]);
		}

		return $this->respond(["message" => "Topic successfully retrieved", "data" => $data]);
	}

	/**
	 * @api {get} /topic/:id Get topic
	 * @apiName show
	 * @apiGroup Topics
	 *
	 * @apiParam {Number} id The topic ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new TopicsModel();
		$data = $model->getTopics($id);

		if (empty($data)) {
			return $this->respond(["message" => "No topics found at id `$id`"], 204);
		}

		return $this->respond(["data" => $data]);
	}

	/**
	 * @api {put} /topic/:id Update topic
	 * @apiName update
	 * @apiGroup Topics
	 *
	 * @apiParam {Number} id          The topic ID
	 * @apiParam {String} [subject]   The topic subject
	 * @apiParam {Number} [id_author] The user ID of the topic's author
	 * @apiParam {Number} [id_answer] The message ID which serves as an answer
   *
	 * @apiUse GenericResponse
	 */
	public function update(int $id)
	{
		try {
			$model = new TopicsModel();
			$data = $this->getRequest($this->request);
			$model->update($id, $data);
			return $this->respond(["message" => "Topic updated successfully", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(["message" => "Can't update topic", "error" => $e->getMessage()]);
		}
	}

	/**
	 * @api {post} /topic Create topic
	 * @apiName create
	 * @apiGroup Topics
	 *
	 * @apiParam {String} subject     The topic subject
	 * @apiParam {Number} id_author   The user ID of the topic's author
   *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"subject" => "required|max_length[255]|is_unique[topic.subject]",
		];

		$model = new TopicsModel();
		$data = $this->getRequest($this->request);

		if ($this->validateRequest($data, $rules)) {
			helper("jwt");
			$data["id_author"] = getTokenInfo($this->request)[0];
			$model->insert($data);
		} else {
			return $this->fail($this->validator->getErrors());
		}
		$data = $model->where(["subject" => $data["subject"]])->first();
		return $this->respondCreated($data);
	}
	
	/**
	 * @api {get} /topic/:id/messages Get topic messages
	 * @apiName getMessages
	 * @apiGroup Topics
	 *
	 * @apiParam {Number} id The topic ID
	 *
	 * @apiUse GenericResponse
	 */
	public function getMessages(int $id_topic = null)
	{
		if(is_null($id_topic)) {
			return $this->fail([
				"message" => "No topic to pick messages from.",
			]);
		}

		$model = new MessagesModel();
		$data = $model->getMessagesFromTopic($id_topic);
		return $this->respond([
			"message" => "Messages successfully retrieved",
			"data"	  => $data
		]);
	}

	/**
	 * @api {delete} /topic/:id Delete topic
	 * @apiName delete
	 * @apiGroup Topics
	 *
	 * @apiParam {Number} id The topic ID
	 *
	 * @apiUse GenericResponse
	 */
	public function delete(int $id) 
	{
		try {
			$model = new TopicsModel();
			$model->delete(["id" => $id]);
			return $this->respond(["message" => "Topic successfully deleted"]);
		} catch (\Exception $e) {
			return $this->fail(
				[ 
					"error" => "The deletion cannot be made",
				  "message" => $e->getMessage()
				]);
		}
	}
}
