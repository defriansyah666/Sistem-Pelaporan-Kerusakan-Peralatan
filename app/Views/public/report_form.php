<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Kerusakan - PA Lubuksikaping</title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/assets/images/bg.png') center/cover no-repeat fixed;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 32px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container-narrow">
        <div class="form-card mx-auto" style="max-width: 800px;">

            <div class="text-center mb-4">
                <h1 class="text-blue">PENGADILAN AGAMA LUBUKSIKAPING</h1>
                <div class="text-muted fs-3 mt-1">Sistem Pelaporan Kerusakan Peralatan</div>
            </div>

            <!-- Success -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success text-center fw-bold fs-3 mb-3">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Error -->
            <?php if ($errors = session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $e): ?>
                        <div>• <?= esc($e) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form action="/laporan" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama Pelapor</label>
                        <input type="text" name="nama_pelapor" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Unit Kerja</label>
                        <input type="text" name="unit_kerja" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Jenis Barang Rusak</label>
                    <input type="text" name="jenis_barang" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi Kerusakan</label>
                    <textarea name="deskripsi" rows="5" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Foto Bukti (max 5MB)</label>
                    <input type="file" name="foto" accept="image/*" class="form-control" required>
                </div>

                <div class="row mt-4">
                    <div class="col-6 text-start">
                        <button type="submit" class="btn btn-primary btn-lg px-5 w-100">
                            <i class="ti ti-send"></i> KIRIM LAPORAN
                        </button>
                    </div>
                    <div class="col-6 text-end">
                        <a href="/login" class="btn btn-secondary btn-lg px-5 w-100">
                            <i class="ti ti-login"></i> LOGIN
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>

</body>

</html>