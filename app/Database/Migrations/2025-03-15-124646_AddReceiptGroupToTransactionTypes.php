<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReceiptGroupToTransactionTypes extends Migration
{
    public function up()
    {
        $fields = [
            'receipt_group' => [
                'type'       => 'SMALLINT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0, // Default group value
                'after'    => 'trans_type',
            ],
        ];

        $this->forge->addColumn('transaction_types', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction_types', 'receipt_group');
    }
}
