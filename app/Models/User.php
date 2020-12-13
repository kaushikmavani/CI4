<?php 

namespace App\Models;
use CodeIgniter\Model;
use Config\Services;

class User extends Model
{
	protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['firstname', 'lastname', 'email', 'password', 'gender', 'role', 'phone_no', 'status', 'profile', 'email_verify', 'verification_token', 'resetpass_token', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function hashPassword(array $data)
	{
	    if (! isset($data['password'])) { return $data; }

	    $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
	    // unset($data['data']['password'];

	    return $data['password_hash'];
	}

	public function verifyPassword(string $loginpassword, string $hashpassword)
	{
		if (! isset($loginpassword)) { return $data; }

		$data['password_hash'] = password_verify($loginpassword, $hashpassword);

		return $data['password_hash'];
	}
}

?>