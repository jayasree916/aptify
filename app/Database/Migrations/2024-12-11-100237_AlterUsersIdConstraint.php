<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersIdConstraint extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10, // Update constraint to 10
                'unsigned'       => true,
                'auto_increment' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('users', [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11, // Original constraint
                'unsigned'       => true,
                'auto_increment' => true,
            ],
        ]);
    }
}
