<?php
namespace App\Models;

use CodeIgniter\Model;

class ApprovalModel extends Model
{
    protected $table = 'approvals';
    protected $allowedFields = ['report_id','status_approval','catatan_atasan','approved_by','approved_at'];
}