<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermissionTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          	=> [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'user_id'       => [
                    'type'           => 'INT',
            ],
            'permission'    => [
                    'type'           => 'TEXT',
            ]
	    ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('role_permission');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('role_permission');
	}
}
