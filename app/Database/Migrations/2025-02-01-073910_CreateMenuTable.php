<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        // Create menus table
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'url'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('menus');

        // Create menu_roles pivot table
        $this->forge->addField([
            'menu_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'role_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'user_roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_roles');
    }

    public function down()
    {
        $this->forge->dropTable('menu_roles');
        $this->forge->dropTable('menus');
    }
}
