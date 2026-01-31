<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PA Lubuksikaping</title>

    <!-- Tabler Core -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">

    <!-- Background -->
    <style>
        body {
            background: url('/assets/images/bg.png') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 40px 32px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }

        .form-label {
            margin-bottom: 6px;
            font-weight: 600;
        }

        .input-group-text {
            background: #f1f5f9;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <h2 class="h1 text-center mb-4 fw-bold text-primary">
            <i class="ti ti-lock me-2"></i>
            LOGIN SISTEM
        </h2>

        <!-- Flash Message -->
        <?php if(session()->getFlashdata('error') || session()->getFlashdata('msg')): ?>
            <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                <div>
                    <?= session()->getFlashdata('error') ?: session()->getFlashdata('msg') ?>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="/login" method="post" autocomplete="off">
            <?= csrf_field() ?>

            <!-- Username -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="ti ti-user me-1"></i> Username
                </label>
                <div class="input-group input-group-flat">
                    <span class="input-group-text">
                        <i class="ti ti-user-circle"></i>
                    </span>
                    <input type="text" 
                           name="username" 
                           class="form-control" 
                           placeholder="Masukkan username" 
                           required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="form-label">
                    <i class="ti ti-key me-1"></i> Password
                </label>
                <div class="input-group input-group-flat">
                    <span class="input-group-text">
                        <i class="ti ti-lock"></i>
                    </span>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control" 
                           placeholder="Masukkan password" 
                           required>

                    <!-- Toggle Password -->
                    <span class="input-group-text cursor-pointer" onclick="togglePassword()">
                        <i class="ti ti-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                <i class="ti ti-login me-1"></i> MASUK
            </button>

        </form>

        <!-- Info Akun Default -->
        <div class="text-center text-muted mt-4 small">
            <p class="mb-1">Akun default:</p>
            <p class="mb-0">admin / admin123</p>
            <p class="mb-0">it / it123</p>
            <p class="mb-0">atasan / atasan123</p>
        </div>

    </div>

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

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta19/dist/js/tabler.min.js"></script>

</body>
</html>
