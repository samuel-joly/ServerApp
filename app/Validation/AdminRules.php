<?php

namespace App\Validation;

use Exception;

class AdminRules
{
    public function is_admin($str, string $fields, array $data) : bool 
    {
      try {
          helper('jwt');
          $role = getTokenInfo($data);
      } catch (Exception $e) {
          return false;
      }
			$id_token = $tokenInfo[0];
			$role = $tokenInfo[1];
			if($role == 10){
					return Services::response()
						->setJSON([
							"error" => "You do not have the permission"
						]
					);
			}
    }

}

