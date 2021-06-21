<?php
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\TopicTagsModel;

class TopicTag extends BaseController
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
	 * @api {get} /topicTag Get all topic tags
	 * @apiName index
	 * @apiGroup Topic Tags
	 *
	 * @apiUse GenericResponse
	 */
	public function index()
	{
		$model = new TopicTagsModel();

		$data = $model->getTopicTags();

		if (empty($data)) {
			return $this->respond(["message" => "No tags found"]);
		}
	
		return $this->respond(["message" => "Tags retrieved successfully", "data" => $data]);
	}

	/**
	 * @api {delete} /topic/:id/tag/:id_tag Delete topic tag
	 * @apiName delete
	 * @apiGroup Topic Tags
	 *
	 * @apiParam {Number} id     The topic ID
	 * @apiParam {Number} id_tag The tag ID to take off
	 *
	 * @apiUse GenericResponse
	 */
	public function delete(int $id_topic, int $id_tag) 
	{
		$rules = [
			"id_tag" => "required|tag_exists[TopicTag.id_tag]",
			"id_topic" => "required|topic_exists[TopicTag.id_topic]"
		];
		$messages = [
			"id_tag" => [
				"required"=> "id_tag may not be empty",
				"tag_exists" => "Tag should exist"
			],
				'id_topic' => [
					"required" => "id_topic may not be empty",
					"topic_exists"=>"Topic should exist"
				]
		];

		$data["id_topic"] = $id_topic;
		$data["id_tag"] = $id_tag;
		$model = new TopicTagsModel();
		if ($this->validateRequest($data, $rules, $messages)) {
			$model->where(["id_tag" => $data["id_tag"]])->delete();
			return $this->respond([
				"message" => "Tag successfully deleted from topic `$id_topic`",
			]);
		} else {
			return $this->fail([
				"message" => "Cannot delete tag from topic `$id_topic`",
				"errors" => $this->validator->getErrors()
			]);
		}
	}
	
	/**
	 * @api {post} /topic/:id/tag/:id_tag Create topic tag
	 * @apiName create
	 * @apiGroup Topic Tags
	 *
	 * @apiParam {Number} id     The topic ID
	 * @apiParam {Number} id_tag The tag ID to take off
	 *
	 * @apiUse GenericResponse
	 */
	public function create(int $id_topic = null, int $id_tag = null)
	{
		$data["id_topic"] = $id_topic;
		$data["id_tag"] = $id_tag;

		$rules = [
			"id_tag"		=> "required|tag_exists[tag.id_tag]",
			"id_topic"		=> "required|topic_exists[tag.id_topic]"
		];

		$messages = [
			"id_tag" => [
				"required"=> "Tag may not be empty",
				"tag_exists" => "Tag should exist"
			],
			"id_topic" => [
				"required"=> "Topic may not be empty",
				"topic_exists" => "Topic should exist"
			],
		];

		$model = new TopicTagsModel();

		if ($this->validateRequest($data,$rules, $messages)) {
			if ($model->isTagInTopic($id_tag, $id_topic)) {
				$model->where($data)->delete();
				return $this->respond([
					"message" => "Tag successfully deleted from topic `$id_topic`",
					"data" => $data
				]);
			} else {
				$model->insert($data);
				return $this->respond([
					"message" => "Tag successfully added to topic `$id_topic`",
					"data" => $data
				]);
			}
		} else {
			return $this->fail([
				"message" => "Cannot retrieve tag of topic $id_topic",
				"errors" => $this->validator->getErrors()
			]);
		}
	}

	/**
	 * @api {get} /topic/:id/tag Get topic tags
	 * @apiName getTagsFromTopic
	 * @apiGroup Topic Tags
	 *
	 * @apiParam {Number} id     The topic ID
	 *
	 * @apiUse GenericResponse
	 */
	public function getTagsFromTopic(int $id_topic = null) 
	{
		if (is_null($id_topic)) {
			$model = new TopicTagsModel();
			return $model->getTopicTags();
		}
		
		$rules = [
			'id_topic' => 'required|topic_exists[topicTag.id_topic]',
		];

		$messages =[
			'id_topic' => [
				'required'	=> 'id_topic may not be empty',
				'topic_exists'	=> 'Topic should exist'
			],
		];

		$data = $this->getRequest($this->request);
		$model = new TopicTagsModel();
		if ($this->validateRequest($data, $rules, $messages)) {
			$data = $model->getTagsFromTopic($data["id_topic"]);
			return $this->respond(["message" => "Tags retrieved successfully", "data" => $data]);
		} else {
			return $this->fail([
				"message" => "Cannot find tags",
				"errors"  => $this->validator->getErrors()
			]);
		}
	}

}
