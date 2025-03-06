<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDescriptionToFacilityBookings extends Migration
{
    public function up()
    {
        $fields = [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'status' // Add after 'status' field
            ]
        ];
        $this->forge->addColumn('facility_bookings', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('facility_bookings', 'description');
    }
}
