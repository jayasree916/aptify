<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBillingTypesTable extends Migration
{
    public function up()
    {
        $fields = [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'billing_type', // Adjust if necessary
            ],
        ];

        $this->forge->addColumn('billing_types', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('billing_types', 'description');
    }
}
