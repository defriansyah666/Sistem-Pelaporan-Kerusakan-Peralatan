<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none mb-3 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Monitoring Peralatan</div>
                        <h2 class="page-title">
                            <i class="ti ti-file-text me-2"></i>
                            Daftar Semua Laporan Kerusakan
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Card Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-alert-triangle me-2"></i>
                        Semua Laporan
                    </h3>
                    <div class="card-actions">
                        <span class="me-3 text-muted">
                            Total: <strong><?= count($reports) ?></strong> laporan
                        </span>
                    </div>
                </div>

                <?php if (empty($reports)): ?>
                    <div class="card-body">
                        <div class="empty">
                            <div class="empty-icon">
                                <i class="ti ti-inbox icon-5xl text-muted"></i>
                            </div>
                            <p class="empty-title">Belum ada laporan kerusakan</p>
                            <p class="empty-subtitle text-muted">
                                Saat ini belum ada data laporan yang tersimpan di sistem.
                            </p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>Pelapor</th>
                                    <th>Unit Kerja</th>
                                    <th>Barang</th>
                                    <th>Estimasi Biaya</th>
                                    <th>Status</th>
                                    <th class="w-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reports as $i => $r): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar me-3">
                                                <i class="ti ti-user"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold"><?= esc($r['nama_pelapor']) ?></div>
                                                <div class="text-muted text-sm"><?= esc($r['nip'] ?? '—') ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($r['unit_kerja']) ?></td>
                                    <td>
                                        <div class="fw-semibold"><?= esc($r['jenis_barang']) ?></div>
                                        <?php if (!empty($r['merk'])): ?>
                                            <div class="text-muted text-sm"><?= esc($r['merk']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($r['estimasi_biaya']): ?>
                                            <strong class="text-success">
                                                Rp <?= number_format($r['estimasi_biaya'], 0, ',', '.') ?>
                                            </strong>
                                        <?php else: ?>
                                            <span class="text-muted">Belum ada estimasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $r['status'];
                                        $badge = match($status) {
                                            'baru'       => 'bg-yellow text-yellow-fg',
                                            'estimasi'   => 'bg-azure text-azure-fg',
                                            'diproses'   => 'bg-blue text-blue-fg',
                                            'disetujui'  => 'bg-green text-green-fg',
                                            'ditolak'    => 'bg-red text-red-fg',
                                            'selesai'    => 'bg-purple text-purple-fg',
                                            default      => 'bg-gray text-gray-fg',
                                        };
                                        $text = match($status) {
                                            'baru'       => 'Baru',
                                            'estimasi'   => 'Estimasi',
                                            'diproses'   => 'Diproses',
                                            'disetujui'  => 'Disetujui',
                                            'ditolak'    => 'Ditolak',
                                            'selesai'    => 'Selesai',
                                            default      => ucfirst($status)
                                        };
                                        ?>
                                        <span class="badge <?= $badge ?>"><?= $text ?></span>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="/reports/view/<?= $r['id'] ?>" class="btn btn-primary btn-icon" title="Lihat Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <?php if (session('role') === 'admin'): ?>
                                                <button onclick="confirmDelete(<?= $r['id'] ?>)" class="btn btn-danger btn-icon" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (isset($pager)): ?>
                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <?= $pager->links('default', 'tabler') ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Konfirmasi Hapus -->
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Laporan Ini?',
        text: "Data akan dihapus permanen dan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        heightAuto: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/reports/delete/${id}`;
        }
    });
}
</script>

<?= $this->endSection() ?>