<?php
namespace App\Controllers;

class Approval extends BaseController
{
    public function form($id)
    {
        $data['report'] = model('ReportModel')->find($id);
        $data['estimation'] = model('ItEstimationModel')->where('report_id', $id)->first();
        $data['approval'] = model('ApprovalModel')->where('report_id', $id)->first();
        return view('approval/form', $data);
    }

    public function submit($id)
    {
        $status = $this->request->getPost('status_approval');
        $model = model('ApprovalModel');
        $data = [
            'report_id'       => $id,
            'status_approval' => $status,
            'catatan_atasan'  => $this->request->getPost('catatan_atasan'),
            'approved_by'     => session('user_id'),
            'approved_at'     => date('Y-m-d H:i:s')
        ];

        $exists = $model->where('report_id', $id)->first();
        if ($exists) {
            $model->update($exists['id'], $data);
        } else {
            $model->insert($data);
        }

        $newStatus = $status === 'disetujui' ? 'disetujui' : 'ditolak';
        model('ReportModel')->update($id, ['status' => $newStatus]);

        return redirect()->to('/reports')->with('success', 'Persetujuan berhasil');
    }
}