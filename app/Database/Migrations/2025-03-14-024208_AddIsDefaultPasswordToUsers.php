<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsDefaultPasswordToUsers extends Migration
{
    public function up()
    {
        // Add new column 'is_default_password' after 'password'
        $this->forge->addColumn('users', [
            'is_default_password' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false,
                'after'      => 'password', // Places the column after 'password'
            ],
        ]);
    }

    public function down()
    {
        // Remove 'is_default_password' column
        $this->forge->dropColumn('users', 'is_default_password');
    }
}
