<?php
namespace App\Controllers;

class ItEstimation extends BaseController
{
    public function edit($id)
    {
        $data['report'] = model('ReportModel')->find($id);
        $data['estimation'] = model('ItEstimationModel')->where('report_id', $id)->first() ?? [];
        return view('it/estimation', $data);
    }

    public function update($id)
    {
        $model = model('ItEstimationModel');
        $data = [
            'report_id'       => $id,
            'estimasi_biaya'  => str_replace(['.', ' '], '', $this->request->getPost('estimasi_biaya')),
            'estimasi_waktu'  => $this->request->getPost('estimasi_waktu'),
            'catatan_it'      => $this->request->getPost('catatan_it'),
        ];

        $exists = $model->where('report_id', $id)->first();
        if ($exists) {
            $model->update($exists['id'], $data);
        } else {
            $model->insert($data);
        }

        model('ReportModel')->update($id, ['status' => 'estimasi']);
        return redirect()->to('/reports')->with('success', 'Estimasi IT berhasil disimpan');
    }
}