<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">

            <!-- Header -->
            <div class="page-header d-print-none mb-4 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Persetujuan Atasan</div>
                        <h2 class="page-title">
                            <i class="ti ti-clipboard-check me-2"></i>
                            Laporan #<?= $report['id'] ?>
                        </h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="/reports" class="btn btn-ghost-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <h3 class="mb-4 fw-semibold">Detail Estimasi</h3>

                            <!-- Info -->
                            <div class="mb-4 pb-3 border-bottom">
                                <p class="mb-2"><strong>Pelapor:</strong> <?= esc($report['nama_pelapor']) ?></p>
                                <p class="mb-2"><strong>Barang:</strong> <?= esc($report['jenis_barang']) ?></p>
                                <p class="mb-2"><strong>Estimasi Biaya:</strong> Rp <?= number_format($estimation['estimasi_biaya'], 0, ',', '.') ?></p>
                                <p class="mb-2"><strong>Estimasi Waktu:</strong> <?= esc($estimation['estimasi_waktu']) ?></p>
                                <p class="mb-0"><strong>Catatan IT:</strong><br><?= nl2br(esc($estimation['catatan_it'])) ?></p>
                            </div>

                            <!-- Form -->
                            <form action="/approval/submit/<?= $report['id'] ?>" method="post">
                                <?= csrf_field() ?>

                                <!-- Keputusan -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-checkup-list me-2"></i>Keputusan
                                    </label>
                                    <div class="d-flex gap-4 mt-2">
                                        <label class="d-flex align-items-center gap-2">
                                            <input type="radio" name="status_approval" value="disetujui" required>
                                            <span class="text-green-700 fw-semibold">SETUJUI</span>
                                        </label>

                                        <label class="d-flex align-items-center gap-2">
                                            <input type="radio" name="status_approval" value="ditolak">
                                            <span class="text-red-700 fw-semibold">TOLAK</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Catatan Atasan -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-notes me-2"></i>Catatan Atasan
                                        <span class="text-muted">(Wajib diisi jika ditolak)</span>
                                    </label>
                                    <textarea name="catatan_atasan"
                                        rows="5"
                                        class="form-control"
                                        placeholder="Berikan catatan Anda..."></textarea>
                                </div>

                                <!-- Tombol -->
                                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                                    <button type="submit" class="btn btn-success btn-lg w-100">
                                        <i class="ti ti-send me-2"></i>Kirim Keputusan
                                    </button>
                                    <a href="/reports" class="btn btn-ghost-secondary btn-lg w-100">
                                        <i class="ti ti-x me-2"></i>Batal
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?= $this->endSection() ?>