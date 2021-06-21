<?php

namespace App\Validation;

use Exception;
use App\Models\UsersModel;

class UserRules
{
	public function user_exists($str, string $fields, array $data) : bool 
	{
		$users = new UsersModel();
		$user = $users->getUser($data["id_user"]);     
		if(empty($data))
		{
			return false;
		} else {
			return true;
		}
		return true;
	}


}



