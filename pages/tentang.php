<?php

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subjek = trim($_POST['subjek'] ?? '');
    $isi_pesan = trim($_POST['isi_pesan'] ?? '');
    $user_id = $_SESSION['user_id'] ?? null;

    if ($nama === '' || $email === '' || $subjek === '' || $isi_pesan === '') {
        $error = 'Semua field wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO pesan (user_id, nama_pengirim, email_pengirim, subjek, isi_pesan) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "issss", $user_id, $nama, $email, $subjek, $isi_pesan);
        if (mysqli_stmt_execute($stmt)) {
            $success = 'Pesan kamu berhasil dikirim!';

            $_POST = [
                'nama' => '',
                'email' => '',
                'subjek' => '',
                'isi_pesan' => ''
            ];
            $nama = $email = $subjek = $isi_pesan = '';

        } else {
            $error = 'Gagal mengirim pesan. Silakan coba lagi.';
        }
    }
}
?>

<main>
    <div class="container container-about">
        <section class="about-us">
            <h2 class ="fw-bold">Tentang VeeBeauté</h2>
            <p>
                <strong>Selamat datang di pusatnya self-care dan glow-up goals! </strong> 
                <br> Website ini adalah beauty store online yang siap jadi sahabat kamu, kami 
                menyediakan produk self care seperti skincare dan makeup dari berbagai brand 
                populer. Kamu bisa tampil maksimal tanpa ribet, kami percaya bahwa setiap orang 
                berhak tampil percaya diri dengan kulit sehat dan terawat. Temukan berbagi inspirasi, 
                tips, dan produk favorit kamu!</br>
        </section>

        <section class="mb-5">
            <h3 class="fw-bold">Punya Pertanyaan?</h3>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post" action="#form-pesan" id="form-pesan" class="mt-3">
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" 
                        required value="<?= htmlspecialchars($_POST['nama'] ?? ($_SESSION['username'] ?? '')); ?>">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                        required value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label for="subjek" class="form-label">Subjek</label>
                    <input type="text" name="subjek" id="subjek" class="form-control" 
                        required value="<?= htmlspecialchars($_POST['subjek'] ?? ''); ?>">
                </div>
                <div class="mb-4">
                    <label for="isi_pesan" class="form-label">Pesan</label>
                    <textarea name="isi_pesan" id="isi_pesan" class="form-control" rows="4" 
                        required><?= htmlspecialchars($_POST['isi_pesan'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-skin">Kirim Pesan</button>
            </form>
        </section>
        
        <section class="text-center" style="margin-bottom: 3rem;">
            <h3 class="mb-4 fw-bold">Hubungi Kami</h3>
            <p style="margin-bottom: 3rem;">Mau ngobrol langsung atau kepoin kami? Kamu bisa temukan kami disini!</p>
            <div class="kontak-wrapper d-flex justify-content-center flex-wrap mt-4 gap-4 text-center" style="color: #7c2a36;">
                <div>
                    <i class="fas fa-map-marker-alt me-2"></i><strong>Alamat Toko :</strong><br>Jl. Mawar No. 12, Jakarta Selatan
                </div>
                <div>
                    <i class="fas fa-envelope me-2"></i><strong>Email :</strong><br>veebeaute@gmail.com
                </div>
                <div>
                    <i class="fab fa-whatsapp me-2"></i><strong>WhatsApp :</strong><br>
                    <a href="https://wa.me/6281317648201" target="_blank" class="text-dark">+62 812-1764-8201</a>
                </div>
                <div>
                    <strong>Media Sosial :</strong><br>
                    <div class="sosmed-links me-3">
                        <a href="https://www.instagram.com/veebeaute" target="_blank" class="text-dark me-3">
                            <i class="fab fa-instagram fa-lg me-1"></i> @veebeaute
                        </a>
                        <a href="https://www.tiktok.com/@veebeaute" target="_blank" class="text-dark me-3">
                            <i class="fab fa-tiktok fa-lg me-1"></i> @veebeaute
                        </a>
                        <a href="https://www.facebook.com/veebeaute" target="_blank" class="text-dark me-3">
                            <i class="fab fa-facebook fa-lg me-1"></i> veebeauté
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</main>
