<?php 

namespace App\Models;
use CodeIgniter\Model;

class Module extends Model
{
	protected $table      = 'modules';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['module', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

?>