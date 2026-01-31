<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page">
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page header -->
            <div class="page-header d-print-none mb-3 card">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-pretitle">Pengaturan Sistem</div>
                        <h2 class="page-title">
                            <i class="ti ti-users me-2"></i>
                            Manajemen Pengguna
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <a href="/users/create" class="btn btn-primary">
                            <i class="ti ti-user-plus me-2"></i>
                            Tambah Pengguna
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ti ti-list-details me-2"></i>
                                Daftar Pengguna Sistem
                            </h3>
                            <div class="card-actions">
                                <span class="text-muted">
                                    Total: <strong><?= count($users) ?></strong> pengguna
                                </span>
                            </div>
                        </div>

                        <?php if (empty($users)): ?>
                            <div class="card-body">
                                <div class="empty">
                                    <div class="empty-icon">
                                        <i class="ti ti-users icon-5xl text-muted"></i>
                                    </div>
                                    <p class="empty-title">Belum ada pengguna terdaftar</p>
                                    <p class="empty-subtitle text-muted">
                                        Silakan tambah pengguna pertama melalui tombol di atas.
                                    </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No</th>
                                            <th>Pengguna</th>
                                            <th>Nama Lengkap</th>
                                            <th>Role</th>
                                            <th>Terakhir Login</th>
                                            <th class="w-1 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $i => $u): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar me-3" style="background-image: none;">
                                                        <i class="ti ti-user"></i>
                                                    </span>
                                                    <div>
                                                        <div class="fw-semibold"><?= esc($u['username']) ?></div>
                                                        <div class="text-muted text-sm"><?= esc($u['email'] ?? '—') ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= esc($u['nama_lengkap']) ?></td>
                                            <td>
                                                <?php
                                                $roleInfo = match($u['role']) {
                                                    'admin'  => ['Admin', 'bg-red', 'text-red-fg'],
                                                    'atasan' => ['Atasan', 'bg-orange', 'text-orange-fg'],
                                                    'it'     => ['Tim IT', 'bg-cyan', 'text-cyan-fg'],
                                                    'user'   => ['User', 'bg-green', 'text-green-fg'],
                                                    default  => [ucfirst($u['role']), 'bg-gray', 'text-gray-fg'],
                                                };
                                                ?>
                                                <span class="badge <?= $roleInfo[1] ?> <?= $roleInfo[2] ?>">
                                                    <i class="ti ti-shield me-1"></i>
                                                    <?= $roleInfo[0] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap justify-center">
                                                    <a href="/users/edit/<?= $u['id'] ?>" class="btn btn-ghost-primary btn-icon" title="Edit">
                                                        <i class="ti ti-edit"></i>
                                                    </a>

                                                    <?php if (session('user_id') != $u['id']): ?>
                                                        <button onclick="confirmDelete(<?= $u['id'] ?>, '<?= esc($u['nama_lengkap'], 'js') ?>')"
                                                                class="btn btn-ghost-danger btn-icon" title="Hapus">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <span class="text-muted text-xs">Akun Anda</span>
                                                    <?php endif; ?>
                                                </div>
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
    </div>
</div>

<!-- SweetAlert2 Konfirmasi Hapus -->
<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Pengguna?',
        html: `Anda akan menghapus akun:<br><strong>${nama}</strong><br><br>Data tidak dapat dikembalikan!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/users/delete/${id}`;
        }
    });
}
</script>

<?= $this->endSection() ?>