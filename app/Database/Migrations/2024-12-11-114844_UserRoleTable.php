<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'unsigned'  => true,
                'null'       => false,  
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'unsigned'  => true,
                'null'       => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Add foreign keys
        // $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'SET NULL');
        // $this->forge->addForeignKey('updated_by', 'users', 'id', 'CASCADE', 'SET NULL');

        // Create the table
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
