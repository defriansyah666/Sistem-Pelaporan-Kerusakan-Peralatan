<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="page-header d-print-none mb-4 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Manajemen Pengguna</div>
                        <h2 class="page-title">
                            <i class="ti ti-<?= isset($user) ? 'user-edit' : 'user-plus' ?> me-2"></i>
                            <?= isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' ?>
                        </h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="/users" class="btn btn-ghost-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <!-- Form Container -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <form action="<?= isset($user) ? "/users/update/{$user['id']}" : '/users/store' ?>" method="post">
                                <?= csrf_field() ?>

                                <!-- Username -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-at me-2"></i>Username
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <input type="text"
                                            name="username"
                                            class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                                            value="<?= old('username', $user['username'] ?? '') ?>"
                                            placeholder="Masukkan username"
                                            required>
                                    </div>
                                </div>

                                <!-- Nama Lengkap -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-id me-2"></i>Nama Lengkap
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ti ti-user-circle"></i>
                                        </span>
                                        <input type="text"
                                            name="nama_lengkap"
                                            class="form-control <?= isset($errors['nama_lengkap']) ? 'is-invalid' : '' ?>"
                                            value="<?= old('nama_lengkap', $user['nama_lengkap'] ?? '') ?>"
                                            placeholder="Nama lengkap pengguna"
                                            required>
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-shield me-2"></i>Role / Hak Akses
                                    </label>
                                    <select name="role"
                                        class="form-select <?= isset($errors['role']) ? 'is-invalid' : '' ?>"
                                        required>
                                        <option value="" disabled>-- Pilih Role --</option>
                                        <option value="admin" <?= old('role', $user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin (Akses Penuh)</option>
                                        <option value="atasan" <?= old('role', $user['role'] ?? '') === 'atasan' ? 'selected' : '' ?>>Atasan (Approval Laporan)</option>
                                        <option value="it" <?= old('role', $user['role'] ?? '') === 'it' ? 'selected' : '' ?>>Tim IT (Estimasi & Perbaikan)</option>
                                        <option value="user" <?= old('role', $user['role'] ?? '') === 'user' ? 'selected' : '' ?>>User Biasa</option>
                                    </select>
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold mb-2">
                                        <i class="ti ti-lock me-2"></i>Password
                                        <?php if (isset($user)): ?>
                                            <span class="text-muted">(Kosongkan jika tidak ingin mengganti)</span>
                                        <?php else: ?>
                                            <span class="text-danger">(Wajib diisi)</span>
                                        <?php endif; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ti ti-key"></i>
                                        </span>
                                        <input type="password"
                                            name="password"
                                            id="password"
                                            class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                            placeholder="<?= isset($user) ? 'Kosongkan jika tidak diganti' : 'Masukkan password' ?>"
                                            <?= isset($user) ? '' : 'required' ?>>
                                        <button type="button" class="btn input-group-text" onclick="togglePassword()">
                                            <i class="ti ti-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Validation Errors -->
                                <?php if (session()->getFlashdata('errors') || isset($errors)): ?>
                                    <div class="alert alert-danger d-flex align-items-start mt-2">
                                        <i class="ti ti-alert-circle icon me-2 fs-2"></i>
                                        <div>
                                            <strong class="alert-title">Terdapat kesalahan input:</strong>
                                            <ul class="mt-2 mb-0">
                                                <?php
                                                $errors = session()->getFlashdata('errors') ?? $errors ?? [];
                                                foreach ($errors as $error): ?>
                                                    <li><?= esc($error) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Tombol Aksi -->
                                <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="ti ti-device-floppy me-2"></i>
                                        <?= isset($user) ? 'Simpan Perubahan' : 'Buat Pengguna Baru' ?>
                                    </button>
                                    <a href="/users" class="btn btn-ghost-secondary btn-lg w-100">
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

<!-- Toggle Password Visibility -->
<script>
    function togglePassword() {
        const field = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('ti-eye', 'ti-eye-off');
        } else {
            field.type = 'password';
            icon.classList.replace('ti-eye-off', 'ti-eye');
        }
    }
</script>

<?= $this->endSection() ?>