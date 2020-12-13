<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ],
            'role'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
            ],
            'created_at'    => [
                    'type'           => 'TIMESTAMP',
            ],
            'updated_at'    => [
                    'type'           => 'TIMESTAMP',
            ],
	    ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('roles');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('roles');
	}
}
