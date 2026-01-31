<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">

            <!-- Header -->
            <div class="page-header d-print-none mb-4 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Estimasi IT</div>
                        <h2 class="page-title">
                            <i class="ti ti-calculator me-2"></i>
                            Estimasi Biaya & Waktu - Laporan #<?= $report['id'] ?>
                        </h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="/reports" class="btn btn-ghost-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <p class="mb-2"><strong>Pelapor:</strong> <?= esc($report['nama_pelapor']) ?> (<?= esc($report['unit_kerja']) ?>)</p>
                            <p class="mb-4"><strong>Barang:</strong> <?= esc($report['jenis_barang']) ?></p>

                            <form action="/it/estimation/<?= $report['id'] ?>" method="post">
                                <?= csrf_field() ?>

                                <!-- Estimasi Biaya -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="ti ti-currency-dollar me-1"></i>Estimasi Biaya (Rp)
                                    </label>
                                    <input type="text"
                                        name="estimasi_biaya"
                                        value="<?= old('estimasi_biaya', $estimation['estimasi_biaya'] ?? '') ?>"
                                        class="form-control"
                                        placeholder="contoh: 1500000"
                                        required>
                                </div>

                                <!-- Estimasi Waktu -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="ti ti-clock me-1"></i>Estimasi Waktu Pengerjaan
                                    </label>
                                    <input type="text"
                                        name="estimasi_waktu"
                                        value="<?= old('estimasi_waktu', $estimation['estimasi_waktu'] ?? '') ?>"
                                        class="form-control"
                                        placeholder="contoh: 3 hari"
                                        required>
                                </div>

                                <!-- Catatan IT -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="ti ti-notes me-1"></i>Catatan untuk Atasan
                                    </label>
                                    <textarea name="catatan_it" rows="5" class="form-control"><?= old('catatan_it', $estimation['catatan_it'] ?? '') ?></textarea>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex flex-column flex-sm-row gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg flex-1">
                                        <i class="ti ti-device-floppy me-1"></i> Simpan Estimasi
                                    </button>
                                    <a href="/reports" class="btn btn-ghost-secondary btn-lg flex-1">
                                        <i class="ti ti-x me-1"></i> Batal
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