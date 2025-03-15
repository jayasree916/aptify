<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReceiptFieldsToCollections extends Migration
{
    public function up()
    {
        // Add new columns after 'bill_no'
        $this->forge->addColumn('collections', [
            'receipt_year' => [
                'type'       => 'YEAR',
                'null'       => false,
                'after'      => 'bill_no', // Places column after 'bill_no'
            ],
            'receipt_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'after'      => 'receipt_year', // Places column after 'receipt_year'
            ],
        ]);
    }

    public function down()
    {
        // Remove columns if rollback is needed
        $this->forge->dropColumn('collections', ['receipt_year', 'receipt_no']);
    }
}
