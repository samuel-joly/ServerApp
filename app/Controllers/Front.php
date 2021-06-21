<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\TopicsModel;
use App\Models\MessagesModel;
use App\Models\UsersModel;
use App\Models\ReactionsModel;
use App\Models\EmotesModel;

class Front extends BaseController
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
	 * @api {get} /front/topic/:id Get topic (deep)
	 * @apiName getTopic
	 * @apiGroup Front-end
	 *
	 * @apiParam {Number} [id] The topic ID
	 *
	 * @apiUse GenericResponse
	 */
	public function getTopic(int $id_topic = null)
	{
		$topicModel = new TopicsModel();
		$userModel = new UsersModel();
		$reactionModel = new ReactionsModel();
		$messageModel = new MessagesModel();
		$emoteModel = new emotesModel();		
		
		$fillTopic = function(&$topic) use ($userModel, $reactionModel, $messageModel, $emoteModel) {
			$author = $userModel->getUser($topic["id_author"]);
			unset($author["password"]);
			$topic["author"] = $author;
			$topic["messages"] = $messageModel->getMessagesFromTopic($topic["id"]);
	
			foreach ($topic["messages"] as &$message) {
				foreach($reactionModel->getReactionsFromMessage($message["id"]) as $reaction) {
					$messageReaction = $message["reactions"][] = $reaction;
					$messageReaction["emote"] = $emoteModel->getEmotes($reaction["id_emote"]);
				}
	
				$author = $userModel->getUser($message["id_author"]);
				unset($author["password"]);
				$message["author"] = $author;
			}
		};

		$topics = $topicModel->getTopics($id_topic);
		
		if (!isset($id_topic)) {
			foreach ($topics as &$topic) $fillTopic($topic);
		} else {
			$fillTopic($topics);
		}
		
		return $this->respond([
			"message" => "Topics retrieved successfully",
			"data" => $topics
		]);
	}

}

