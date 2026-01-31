<?php
namespace App\Controllers;

use App\Models\ReportModel;

class Reports extends BaseController
{
    public function index()
    {
        $model = new ReportModel();
        $data['reports'] = $model
            ->select('reports.*, it_estimations.estimasi_biaya, it_estimations.estimasi_waktu, approvals.status_approval')
            ->join('it_estimations', 'it_estimations.report_id = reports.id', 'left')
            ->join('approvals', 'approvals.report_id = reports.id', 'left')
            ->orderBy('reports.id', 'DESC')
            ->findAll();

        return view('reports/index', $data);
    }

    public function view($id)
    {
        $data['report'] = model('ReportModel')->find($id);
        $data['estimation'] = model('ItEstimationModel')->where('report_id', $id)->first();
        $data['approval'] = model('ApprovalModel')->where('report_id', $id)->first();
        if (!$data['report']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('reports/view', $data);
    }

    public function delete($id)
    {
        $report = model('ReportModel')->find($id);
        if ($report && $report['foto']) {
            @unlink('writable/uploads/reports/' . $report['foto']);
        }
        model('ReportModel')->delete($id);
        model('ItEstimationModel')->where('report_id', $id)->delete();
        model('ApprovalModel')->where('report_id', $id)->delete();
        return redirect()->to('/reports')->with('success', 'Data laporan dihapus');
    }
}