<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">

            <!-- Page Title -->
            <div class="page-header d-print-none mb-3 card">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Dashboard Monitoring Peralatan
                        </h2>
                        <div class="text-muted mt-1">
                            Selamat datang kembali, <strong><?= esc(session('nama_lengkap')) ?></strong>!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="ti ti-file-text"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Total Laporan</div>
                                    <div class="text-muted h1 mb-0"><?= number_format(count($reports)) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-warning text-white avatar">
                                        <i class="ti ti-clock-hour-3"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Baru</div>
                                    <div class="text-muted h1 mb-0">
                                        <?= number_format(count(array_filter($reports, fn($r) => $r['status'] === 'baru'))) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-info text-white avatar">
                                        <i class="ti ti-hourglass"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Menunggu Approval</div>
                                    <div class="text-muted h1 mb-0">
                                        <?= number_format(count(array_filter($reports, fn($r) => $r['status'] === 'estimasi'))) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <i class="ti ti-check"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Disetujui</div>
                                    <div class="text-muted h1 mb-0">
                                        <?= number_format(count(array_filter($reports, fn($r) => $r['status'] === 'disetujui'))) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Laporan Terbaru -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Laporan Terbaru</h3>
                    <div class="ms-auto">
                        <a href="/reports" class="btn btn-primary btn-sm">
                            <i class="ti ti-list-details"></i>
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <?php if (empty($reports)): ?>
                    <div class="card-body text-center py-5">
                        <div class="empty">
                            <div class="empty-icon">
                                <i class="ti ti-inbox" style="font-size: 4rem;"></i>
                            </div>
                            <p class="empty-title">Belum ada laporan</p>
                            <p class="empty-subtitle text-muted">
                                Saat ini belum ada data laporan yang tersimpan.
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
                                    <th>Barang</th>
                                    <th>Status</th>
                                    <th class="w-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(array_slice($reports, 0, 20) as $i => $r): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <div><?= esc($r['nama_pelapor']) ?></div>
                                    </td>
                                    <td>
                                        <div><?= esc($r['jenis_barang']) ?></div>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $r['status'];
                                        $badge = match($status) {
                                            'baru'       => 'bg-yellow text-yellow-fg',
                                            'estimasi'   => 'bg-azure text-azure-fg',
                                            'disetujui'  => 'bg-green text-green-fg',
                                            'ditolak'    => 'bg-red text-red-fg',
                                            'selesai'    => 'bg-purple text-purple-fg',
                                            default      => 'bg-gray text-gray-fg',
                                        };
                                        $text = ucfirst(str_replace('_', ' ', $status));
                                        ?>
                                        <span class="badge <?= $badge ?>"><?= $text ?></span>
                                    </td>
                                    <td>
                                        <a href="/reports/view/<?= $r['id'] ?>" class="btn btn-ghost-primary btn-icon" title="Lihat Detail">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>