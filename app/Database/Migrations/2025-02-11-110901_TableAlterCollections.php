<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCollections extends Migration
{
    public function up()
    {
        $fields = [
            'Remarks' => [
                'name' => 'remarks', // New name for the column
                'type' => 'TEXT',   // Ensure the type matches the existing column
                'null' => true,     // Adjust based on whether the column allows NULL
            ],
        ];

        $this->forge->modifyColumn('collections', $fields);
    }

    public function down()
    {
        $fields = [
            'remarks' => [
                'name' => 'Remarks', // Revert to the original column name
                'type' => 'TEXT',    // Ensure the type matches the original column
                'null' => true,      // Adjust based on the original column's NULL setting
            ],
        ];

        $this->forge->modifyColumn('collections', $fields);
    }
}
