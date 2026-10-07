<main>
    <div class="container">
        <section class="text-center mb-5">
            <h2 class="mb-3 fw-bold">Inspiration Gallery</h2>
            <p style="margin-bottom: 3rem;">Jelajahi dan temukan gaya yang paling kamu suka!</p>
            <img src="assets/images/galeri/BannerVeeBeauté.png" alt="Banner VeeBeauté" class="img-fluid banner-galeri">
        </section>
        
        <section>
            <div class="row g-4" style="margin-bottom: 4rem">
                <?php
                $queryGaleri = "SELECT * FROM galeri ORDER BY tanggal DESC LIMIT 8";
                $resultGaleri = mysqli_query($conn, $queryGaleri);

                if (mysqli_num_rows($resultGaleri) > 0) {
                    while ($foto = mysqli_fetch_assoc($resultGaleri)) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <img src="assets/images/galeri/<?= htmlspecialchars($foto['gambar']); ?>" class="card-img-top rounded-top" 
                             alt="<?= htmlspecialchars($foto['judul']); ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold"><?= htmlspecialchars($foto['judul']); ?></h5>
                            <p class="card-text small" style="text-align: justify;">
                                <?= htmlspecialchars($foto['deskripsi']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo '<p class="text-center">Belum ada foto di galeri.</p>';
                }
                ?>
            </div>
        </section>
    </div>
</main>
