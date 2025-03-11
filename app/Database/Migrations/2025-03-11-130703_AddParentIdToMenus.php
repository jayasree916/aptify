<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParentIdToMenus extends Migration
{
    public function up()
    {
        $this->forge->addColumn('menus', [
            'parent_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ]);

        // Add a foreign key reference
        $this->db->query('ALTER TABLE `menus` ADD CONSTRAINT `fk_menus_parent` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE');

    }

    public function down()
    {
        $this->forge->dropForeignKey('menus', 'fk_menus_parent');
        $this->forge->dropColumn('menus', 'parent_id');
    }
}
