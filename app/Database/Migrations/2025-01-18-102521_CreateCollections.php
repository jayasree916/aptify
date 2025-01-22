<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCollections extends Migration
{
    public function up()
    {
        // Create transaction type table
        // $this->forge->addField([
        //     'id' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11,
        //         'unsigned'       => true,
        //         'auto_increment' => true,
        //     ],
        //     'trans_type' => [
        //         'type'       => 'VARCHAR',
        //         'constraint' => 100,
        //         'null'       => false,
        //     ],
        //     'is_active' => [
        //         'type'       => 'BOOLEAN',
        //         'default'   => true,
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //     ],
        // ]);
        // $this->forge->addKey('id', true);
        // $this->forge->createTable('transaction_types');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'trans_type' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'payment_mode' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'billing_type' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'paid_by' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'Remarks' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('trans_type', 'transaction_types', 'id', 'CASCADE', 'SET NULL');
        // $this->forge->addForeignKey('payment_mode', 'payment_modes', 'id', 'CASCADE', 'SET NULL');
        // $this->forge->addForeignKey('billing_type', 'billing_types', 'id', 'CASCADE', 'SET NULL');
        // $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'SET NULL');
        // $this->forge->addForeignKey('updated_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('collections');
    }

    public function down()
    {
        //$this->forge->dropTable('transaction_types');
        $this->forge->dropTable('collections');
    }
}
