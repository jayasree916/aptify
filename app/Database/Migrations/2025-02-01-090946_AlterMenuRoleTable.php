<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMenuRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('menu_roles', [
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'after' => 'role_id'],
            'created_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'is_active'],
            'updated_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'created_at'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('menu_roles', ['is_active', 'created_at', 'updated_at']);
    }
}
