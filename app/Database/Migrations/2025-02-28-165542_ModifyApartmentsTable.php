<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyApartmentsTable extends Migration
{
    public function up()
    {
        // Remove 'apartment_no' column
        $this->forge->dropColumn('apartments', 'apartment_no');
    }

    public function down()
    {
        // Re-add 'apartment_no' column if rolled back
        $this->forge->addColumn('apartments', [
            'apartment_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false
            ]
        ]);
    }
}
