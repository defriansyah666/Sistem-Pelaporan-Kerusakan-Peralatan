<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="page-header d-print-none mb-3 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Laporan Kerusakan</div>
                        <h2 class="page-title">
                            <i class="ti ti-file-text me-2"></i>
                            Detail Laporan #<?= sprintf('%04d', $report['id']) ?>
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <a href="/reports" class="btn btn-ghost-secondary">
                            <i class="ti ti-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <!-- Main Card -->
                    <div class="card card-lg">
                        <div class="card-body">

                            <div class="row">
                                <!-- Informasi Utama -->
                                <div class="col-lg-8">

                                    <!-- Pelapor & Unit -->
                                    <div class="row row-cards">
                                        <div class="col-sm-6">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-lg rounded bg-blue-lt">
                                                        <i class="ti ti-user"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"><?= esc($report['nama_pelapor']) ?></div>
                                                    <div class="text-muted"><?= esc($report['nip'] ?? '—') ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-lg rounded bg-indigo-lt">
                                                        <i class="ti ti-building"></i>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">Unit Kerja</div>
                                                    <div class="text-muted"><?= esc($report['unit_kerja']) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Barang & Tanggal -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="mb-1">
                                                <i class="ti ti-device-desktop me-2 text-purple"></i>
                                                <?= esc($report['jenis_barang']) ?>
                                            </h3>
                                            <?php if (!empty($report['merk'])): ?>
                                                <div class="text-muted">Merk: <?= esc($report['merk']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="text-muted">Dilaporkan pada</div>
                                            <div class="h4 mb-0">
                                                <?= date('d M Y', strtotime($report['created_at'])) ?>
                                                <small class="text-muted">pukul <?= date('H:i', strtotime($report['created_at'])) ?></small>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Status -->
                                    <div class="mb-4">
                                        <div class="text-muted mb-2">Status Laporan</div>
                                        <?php
                                        $statusInfo = match($report['status']) {
                                            'baru'       => ['Menunggu Estimasi', 'bg-yellow', 'text-yellow-fg'],
                                            'estimasi'   => ['Menunggu Approval', 'bg-orange', 'text-orange-fg'],
                                            'diproses'   => ['Sedang Diproses', 'bg-blue', 'text-blue-fg'],
                                            'disetujui'  => ['Disetujui', 'bg-green', 'text-green-fg'],
                                            'ditolak'    => ['Ditolak', 'bg-red', 'text-red-fg'],
                                            'selesai'    => ['Selesai', 'bg-purple', 'text-purple-fg'],
                                            default      => [ucfirst($report['status']), 'bg-gray', 'text-gray-fg'],
                                        };
                                        ?>
                                        <span class="badge badge-lg <?= $statusInfo[1] ?> <?= $statusInfo[2] ?>">
                                            <i class="ti ti-clock me-1"></i>
                                            <?= $statusInfo[0] ?>
                                        </span>
                                    </div>

                                    <!-- Deskripsi Kerusakan -->
                                    <div class="mt-5">
                                        <h3 class="mb-3">
                                            <i class="ti ti-align-left me-2 text-teal"></i>
                                            Deskripsi Kerusakan
                                        </h3>
                                        <div class="bg-light rounded p-4 border-start border-4 border-teal">
                                            <p class="mb-0 text-muted whitespace-pre-line"><?= esc($report['deskripsi']) ?></p>
                                        </div>
                                    </div>

                                    <!-- Estimasi IT -->
                                    <?php if ($estimation): ?>
                                        <div class="mt-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h3>
                                                    <i class="ti ti-calculator me-2 text-primary"></i>
                                                    Estimasi dari Tim IT
                                                </h3>
                                                <?php if (in_array(session('role'), ['it', 'admin'])): ?>
                                                    <a href="/it/estimation/<?= $report['id'] ?>" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-edit me-1"></i> Edit Estimasi
                                                    </a>
                                                <?php endif; ?>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="card bg-green-lt">
                                                        <div class="card-body text-center">
                                                            <div class="text-muted small">Estimasi Biaya</div>
                                                            <div class="h3 mb-0 text-success">
                                                                Rp <?= number_format($estimation['estimasi_biaya'], 0, ',', '.') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card bg-blue-lt">
                                                        <div class="card-body text-center">
                                                            <div class="text-muted small">Waktu Pengerjaan</div>
                                                            <div class="h4 mb-0 text-blue"><?= esc($estimation['estimasi_waktu']) ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="text-muted small mb-2">Catatan IT</div>
                                                            <p class="mb-0"><?= nl2br(esc($estimation['catatan_it'])) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Keputusan Atasan -->
                                    <?php if ($approval): ?>
                                        <div class="mt-5">
                                            <h3 class="mb-3">
                                                <?php if ($approval['status_approval'] == 'disetujui'): ?>
                                                    <i class="ti ti-checks text-success me-2"></i>
                                                    <span class="text-success">Disetujui oleh Atasan</span>
                                                <?php else: ?>
                                                    <i class="ti ti-x text-danger me-2"></i>
                                                    <span class="text-danger">Ditolak oleh Atasan</span>
                                                <?php endif; ?>
                                            </h3>
                                            <div class="card <?= $approval['status_approval']=='disetujui' ? 'border-success' : 'border-danger' ?>">
                                                <div class="card-body">
                                                    <div class="text-muted mb-2">Catatan Atasan</div>
                                                    <p class="mb-0"><?= nl2br(esc($approval['catatan_atasan'])) ?: '—' ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Tombol Aksi -->
                                    <div class="mt-5 d-flex flex-wrap gap-3">
                                        <?php if (!$estimation && in_array(session('role'), ['it','admin'])): ?>
                                            <a href="/it/estimation/<?= $report['id'] ?>" class="btn btn-primary">
                                                <i class="ti ti-calculator me-2"></i>
                                                Isi Estimasi IT
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($estimation && !$approval && in_array(session('role'), ['atasan','admin'])): ?>
                                            <a href="/approval/form/<?= $report['id'] ?>" class="btn btn-success">
                                                <i class="ti ti-gavel me-2"></i>
                                                Setujui / Tolak Laporan
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <!-- Foto di samping (kanan) -->
                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <h3 class="mb-3">
                                        <i class="ti ti-camera me-2"></i> Foto Kerusakan
                                    </h3>
                                    <?php if ($report['foto']): ?>
                                        <div class="rounded overflow-hidden shadow-lg border">
                                            <img src="/writable/uploads/reports/<?= esc($report['foto']) ?>"
                                                 alt="Foto kerusakan"
                                                 class="img-fluid">
                                        </div>
                                    <?php else: ?>
                                        <div class="empty">
                                            <div class="empty-icon">
                                                <i class="ti ti-photo-off icon-4xl text-muted"></i>
                                            </div>
                                            <p class="empty-title">Tidak ada foto</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>