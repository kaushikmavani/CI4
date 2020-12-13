<?php 

namespace App\Models;
use CodeIgniter\Model;

class Role extends Model
{
	protected $table      = 'roles';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['role', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

?>