<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApprovalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'report_id'        => ['type' => 'INT', 'unsigned' => true],
            'status_approval'  => ['type' => 'ENUM("disetujui","ditolak")', 'null' => true],
            'catatan_atasan'   => ['type' => 'TEXT', 'null' => true],
            'approved_by'      => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'approved_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('report_id', 'reports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('approved_by', 'users', 'id');
        $this->forge->createTable('approvals');
    }

    public function down()
    {
        $this->forge->dropTable('approvals');
    }
}