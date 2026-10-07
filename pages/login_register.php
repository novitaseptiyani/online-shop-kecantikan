<?php

$login_error = '';
$register_error = '';
$register_success = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['login_username'] ?? '');
    $password = $_POST['login_password'] ?? '';

    if ($username === '' || $password === '') {
        $login_error = 'Semua field harus diisi.';
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM user WHERE username = ? LIMIT 1");
        
        if ($stmt === false) {
            $login_error = 'Kesalahan internal server. Mohon coba lagi nanti.';

        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) === 1) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    $_SESSION['admin_logged_in'] = ($user['role'] === 'admin');

                    if ($user['role'] === 'admin') {

                        header('Location: administrator/index.php?page=dashboard'); 

                    } else {
                        header('Location: index.php?page=home'); 
                    }
                    exit; 
                } else {
                    $login_error = 'Password salah.';
                }
            } else {
                $login_error = 'Akun tidak ditemukan.';
            }
        }
    }
}

if (isset($_POST['register'])) {
    $username = trim($_POST['reg_username'] ?? '');
    $password = $_POST['reg_password'] ?? '';
    $password_confirm = $_POST['reg_password_confirm'] ?? '';
    $email = trim($_POST['reg_email'] ?? '');

    if ($username === '' || $password === '' || $email === '' || $password_confirm === '') {
        $register_error = 'Semua field harus diisi.';
    } elseif ($password !== $password_confirm) {
        $register_error = 'Konfirmasi password tidak cocok.';
    } else {
        $role = '';
        if (ctype_digit($username)) {
            $role = 'admin';
        } elseif (ctype_alpha($username)) {
            $role = 'user';
        } else {
            $register_error = 'Username hanya boleh huruf (user).';
        }

        if (!$register_error) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "INSERT INTO user (username, password, email, role) VALUES (?, ?, ?, ?)");
            
            if ($stmt === false) {
                $register_error = 'Kesalahan internal server. Mohon coba lagi nanti.';
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $username, $hash, $email, $role);

                if (mysqli_stmt_execute($stmt)) {
                    $register_success = 'Pendaftaran berhasil. Silakan login.';
                    unset($_POST['reg_username'], $_POST['reg_email'], $_POST['reg_password'], $_POST['reg_password_confirm']);

                } else {
                    $register_error = 'Pendaftaran gagal. Username/email mungkin sudah terdaftar.';
                }
            }
        }
    }
}
?>

<section class="py-5 auth-section" style="background-color: #fcf1ec;">
    <div class="container" style="margin-bottom: 4rem; margin-top: 1rem;">
        <div class="row overflow-hidden">

            <div class="col-md-5 p-5 bg-white">
                <h3 class="mb-4 text-center fw-bold">Login</h3>
                <?php if ($login_error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($login_error); ?></div>
                <?php endif; ?>
                <form method="post">
                    <input type="hidden" name="login" value="1" />
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="login_username" class="form-control" required value="<?= htmlspecialchars($_POST['login_username'] ?? ''); ?>" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="login_password" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-skin w-100">Masuk</button>
                </form>
            </div>

            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <div style="border-left: 3px solid #7c2a36 ; height: 100%;"></div>
            </div>

            <div class="col-md-5 p-5 bg-white">
                <h3 class="mb-4 text-center fw-bold">Daftar</h3>
                <?php if ($register_error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($register_error); ?></div>
                <?php elseif ($register_success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($register_success); ?></div>
                <?php endif; ?>
                <form method="post">
                    <input type="hidden" name="register" value="1" />
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="reg_username" class="form-control" required value="<?= htmlspecialchars($_POST['reg_username'] ?? ''); ?>" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="reg_email" class="form-control" required value="<?= htmlspecialchars($_POST['reg_email'] ?? ''); ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="reg_password" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="reg_password_confirm" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-skin w-100">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</section>