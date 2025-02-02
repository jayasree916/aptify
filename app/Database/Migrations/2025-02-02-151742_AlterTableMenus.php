<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableMenus extends Migration
{
    public function up()
    {
        $fields = [
            'display_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
                'after' => 'url' // Positioning after 'url' column
            ],
        ];

        $this->forge->addColumn('menus', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('menus', 'display_order');
    }
}
