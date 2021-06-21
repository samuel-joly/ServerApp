<?php

namespace App\Validation;

use Exception;
use App\Models\TopicsModel;
use App\Models\TagsModel;
use Config\Services;

class TopicTagRules
{
	public function topic_exists($str, string $fields, array $data) : bool 
	{
		$topics = new TopicsModel();
		$topic = $topics->getTopics($data["id_topic"]);

		if(empty($topic)){
			return false;
		} else {
			return true; 
		}
	}

	public function tag_exists($str, string $fields, array $data) : bool 
	{
		$model = new TagsModel();
		$id_tag = $model->getTags($data["id_tag"]);

		if(empty($id_tag)){
			return false;
		} else {
			return true;
		}
	}
}


