<?php
namespace App\Models;

use CodeIgniter\Model;

class ItEstimationModel extends Model
{
    protected $table = 'it_estimations';
    protected $allowedFields = ['report_id','estimasi_biaya','estimasi_waktu','catatan_it'];
    protected $useTimestamps = true;
}