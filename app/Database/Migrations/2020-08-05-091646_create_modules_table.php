<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateModulesTable extends Migration
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
            'module'       => [
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
	    $this->forge->createTable('modules');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('modules');
	}
}
