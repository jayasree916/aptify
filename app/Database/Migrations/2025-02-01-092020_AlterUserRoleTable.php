<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserRoleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'user_role' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'contact_no'
            ]
        ]);

        // Add Foreign Key Constraint (Assuming `user_roles` Table Exists)
        $this->db->query("ALTER TABLE users ADD CONSTRAINT fk_users_user_role FOREIGN KEY (user_role) REFERENCES user_roles(id) ON DELETE SET NULL ON UPDATE CASCADE");
    }

    public function down()
    {
        // Remove Foreign Key First
        $this->db->query("ALTER TABLE users DROP FOREIGN KEY fk_users_user_role");

        // Drop the user_role Column
        $this->forge->dropColumn('users', 'user_role');
    }
}
