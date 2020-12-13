<?php

namespace App\Libraries;
use Config\Services;
use Config\Database;

class CheckPermission 
{
	public function check($functionality)
	{
		$permission = Database::connect()->table('role_permission')->where('user_id', Services::session()->get('id'))->get()->getRow();
		if($permission)
		{
			$permission_data = json_decode($permission->permission);
			return (in_array($functionality, $permission_data)) ? true : false;
		}
		else
		{
			return false;
		}
	}
}

?>