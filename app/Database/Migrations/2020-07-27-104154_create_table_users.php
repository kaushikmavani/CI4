<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsers extends Migration
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
            'firstname'   => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => true,
            ],
            'lastname'    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => true,
            ],
            'email'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
            ],
            'password'    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
            ],
            'role'        => [
                    'type'           => 'INT',
            ],
            'gender'      => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
            ],
            'phone_no'    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => true,
            ],
            'status'      => [
                    'type'           => 'INT',
            ],
            'profile'   => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '255',
                    'null'           => true,
            ],
            'email_verify'  => [
                    'type'           => 'INT',
                    'null'           => true,
            ],
            'verification_token'    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => true,
            ],
            'resetpass_token'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '100',
                    'null'           => true,
            ],
            'created_at'    => [
                    'type'           => 'TIMESTAMP',
            ],
            'updated_at'    => [
                    'type'           => 'TIMESTAMP',
            ],
	    ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
