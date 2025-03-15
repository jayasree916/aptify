<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueConstraintsToUsers extends Migration
{
    public function up()
    {
        // Add unique constraints
        $this->forge->modifyColumn('users', [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'unique' => true,
            ],
            'contact_no' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
                'unique' => true,
            ],
        ]);
    }

    public function down()
    {
        // Drop unique constraints
        $this->forge->dropKey('users', 'username');
        $this->forge->dropKey('users', 'contact_no');
    }
}
