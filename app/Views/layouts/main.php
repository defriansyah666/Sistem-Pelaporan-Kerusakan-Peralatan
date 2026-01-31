<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Monitoring Peralatan - PA Lubuksikaping' ?></title>

    <!-- Tabler Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 64px;
            --primary: #2563eb;
            --danger: #dc2626;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: url('/assets/images/bg.png') center/cover no-repeat fixed;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(8px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.08);
            position: fixed;
            left: 0;
            top: 0;
            height: 160vh;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
            height: var(--header-height);
        }

        .sidebar-logo {
            height: 42px;
            width: auto;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.5rem;
            color: #64748b;
            text-decoration: none;
            transition: all 0.25s;
            border-left: 4px solid transparent;
        }

        .nav-item:hover {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .nav-item.active {
            background-color: #eff6ff;
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-item i {
            width: 22px;
            margin-right: 12px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Header */
        .header {
            height: var(--header-height);
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #475569;
            cursor: pointer;
            margin-right: 1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }

        .content {
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
        }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s;
            }

            .overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }

        /* Alert & Card */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.75rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="/assets/images/logo.png" class="sidebar-logo" alt="Logo">
                <div>
                    <h3 class="m-0 fs-5 fw-bold">PA Lubuksikaping</h3>
                    <small class="text-muted">Monitoring Peralatan</small>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="/dashboard" class="nav-item <?= current_url(true)->getPath() === '/dashboard' ? 'active' : '' ?>">
                    <i class="ti ti-layout-dashboard"></i> Dashboard
                </a>
                <a href="/reports" class="nav-item <?= current_url(true)->getPath() === '/reports' ? 'active' : '' ?>">
                    <i class="ti ti-file-description"></i> Semua Laporan
                </a>
                <?php if (session('role') === 'admin'): ?>
                    <a href="/users" class="nav-item <?= current_url(true)->getPath() === '/users' ? 'active' : '' ?>">
                        <i class="ti ti-users"></i> Manajemen User
                    </a>
                <?php endif; ?>

                <div class="nav-item text-danger" id="logoutMobile" style="cursor:pointer;">
                    <i class="ti ti-logout"></i> Logout
                </div>
            </nav>
        </aside>

        <!-- Mobile Overlay -->
        <div class="overlay" id="overlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="ti ti-menu-2"></i>
                    </button>
                </div>
            </header>

            <!-- Content -->
            <main class="content">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="ti ti-check"></i>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-error">
                        <i class="ti ti-x"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Logout confirmation
        function confirmLogout() {
            Swal.fire({
                title: "Keluar dari sistem?",
                text: "Anda akan logout dari aplikasi",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Logout"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/logout";
                }
            });
        }

        document.getElementById('logoutMobile')?.addEventListener('click', confirmLogout);
    </script>
</body>

</html>