<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\MessagesModel;
use App\Models\ReactionsModel;

class Message extends BaseController
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
	 * @api {get} /messages Get messages
	 * @apiName index
	 * @apiGroup Messages
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new MessagesModel();
		$data = $model->getMessages();

		if (empty($data))
		{
			return $this->respond(["message" => "No message found"]);
		}

		return $this->respond(["message" => "Message successfully retrieved", "data" => $data]);
	}

/**
	 * @api {get} /messages/:id Get message
	 * @apiName show
	 * @apiGroup Messages
	 *
	 * @apiParam {Number} id The message ID
	 *
	 * @apiUse GenericResponse
	 */
	public function show($id = null)
	{
		$model = new MessagesModel();
		$data = $model->getMessages($id);

		if (empty($data)) {
			return $this->respond(["message" => "No messages found at id `$id`"], 204);
		}

		return $this->respond(['message' => "Messages retrieved successfully","data" => $data]);
	}


	/**
	 * @api {put} /message/:id Update message
	 * @apiName update
	 * @apiGroup Messages
	 *
	 * @apiParam {Number} id            The message ID
	 * @apiParam {String} [content]     The message's content
	 * @apiParam {String} [id_author]   The user ID of the message's author (admin only)
	 * @apiParam {String} [id_topic]    The topic ID of the message
	 *
	 * @apiUse GenericResponse
	 */
	public function update(int $id)
	{
		try {
			helper("jwt");
			$data = $this->getRequest($this->request);
			[$id_author, $role] = getTokenInfo($this->request);
			if ($role != 10 && $data["id_author"]) $data["id_author"] = $id_author;
			
			$model = new MessagesModel();
			$model->update($id, $data);
			$data = $model->getMessages($id);
			return $this->respond(["message" => "Message updated successfully", "data" => $data]);
		} catch (\Exception $e) {
			return $this->fail(["error" => $e->getMessage()]);
		}
	}

	/**
	 * @api {post} /message Create message
	 * @apiName create
	 * @apiGroup Messages
	 *
	 * @apiParam {String} content     The message's content
	 * @apiParam {String} id_topic  The topic ID of the message
	 *
	 * @apiUse GenericResponse
	 */
	public function create()
	{
		$rules = [
			"content" => "required",
			"id_topic" => "required|topic_exists[message.id_topic]"
		];

		$messages = [
			"content" => ["required" => "The message cannot be empty"],
			"id_topic" => [
				"required" => "The id_topic cannot be empty",
				"topic_exists" => "The topic should exist"
			],
		];

		$model = new MessagesModel();
		$data = $this->getRequest($this->request);

		if ($this->validateRequest($data,$rules, $messages)) 
		{
			helper("jwt");
			$data["id_author"] = getTokenInfo($this->request)[0];
			$model->insert($data);

			return $this->respondCreated([
				"message" => "Message created successfully",
				"data" 		=> $data
			]);
		}
	 	else 
		{
			return $this->fail([
				"message" => "Wrong inputs given",
				"error" 	=> $this->validator->getErrors()
			]);
		}	
	}

	/**
	 * @api {get} /message/:id/reactions Get message reactions
	 * @apiName getReactions
	 * @apiGroup Messages
	 *
	 * @apiParam {Number} id The message ID
	 *
	 * @apiUse GenericResponse
	 */
	public function getReactions(int $id_message = null)
	{
		if (is_null($id_message)) {
			return $this->fail([
				"message" => "No message to pick reaction from.",
			]);
		}

		$model = new ReactionsModel();
		$data = $model->getReactionsFromMessage($id_message);

		return $this->respond([
			"message" => "Reactions successfully retrieved",
			"data"		=> $data
		]);
	}

	/**
	 * @api {post} /message/:id/react/:id_emote Toggle message reaction
	 * @apiName addReaction
	 * @apiGroup Messages
	 *
	 * @apiParam {Number} id The message ID
	 * @apiParam {Number} id_emote The emote ID
	 *
	 * @apiUse GenericResponse
	 */
	public function addReaction(int $id_message, int $id_emote)
	{
		$rules = [
			"id_message" => "required|message_exists[message.id_message]",
			"id_emote" => "required|emote_exists[message.id_reaction]",
			"id_user" => "required|user_exists[message.id_user]"
		];

		$messages = [
			"id_message" => [
				"required" => "id_message may not be empty",
				"message_exists" => "Message should exist"
			],
			"id_emote" => [
				"required" => "id_emote may not be empty",
				"emote_exists" => "Emote should exist"
			],
			"id_user" => [
				"required" => "id_user may not be empty",
				"user_exists" => "User should exist"
			]
		];

		helper("jwt");
		$id_user = getTokenInfo($this->request)[0];	 
		$data = [
			"id_message" => $id_message,
			"id_user" => $id_user,
			"id_emote" => $id_emote,
		];

		$model = new ReactionsModel();
		if ($this->validateRequest($data, $rules, $messages))
		{
			if (!$model->reactionExists($id_user, $id_emote))
			{
				$model->insert($data);
				return $this->respond([
					"message" => "Reaction added to message",
					"data"		=> $data
				]);
			} else {
				$model->where($data)->delete();
				return $this->respond([
					"message" => "Reaction deleted from message",
					"data"		=> $data
				]);
			}
		} else {
			return $this->respond([
				"message" => "Wrong inputs given",
				"errors" 	=> $this->validator->getErrors()
			]);
		}
	}
}
