<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT * FROM berita WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $berita = mysqli_fetch_assoc($result);
    } else {
        header('Location: index.php?page=berita'); 
        exit;
    }
} else {
    header('Location: index.php?page=berita');
    exit;
}
?>

<main style="background-color: #fcf1ec;">
    <div class="container">
        <article class="mt-5">
            <h1 class="mb-3 text-center fw-bold"><?= htmlspecialchars($berita['judul']); ?></h1>
            <p class="text-muted mb-4">Dipublikasikan pada : <?= date('d M Y', strtotime($berita['tanggal'])); ?></p>
            <?php if (!empty($berita['gambar'])): ?>
                <img src="assets/images/Berita/<?= htmlspecialchars($berita['gambar']); ?>" alt="<?= htmlspecialchars($berita['judul']); ?>" 
                    class="img-fluid rounded mb-4" style="max-height: 500px; object-fit: cover; width: 100%;">
            <?php endif; ?>
            
            <div class="berita-content" style="color: #7c2a36">
                <?= nl2br(htmlspecialchars($berita['isi'])); ?>
            </div>
            <a href="index.php?page=berita" class="btn btn-skin mt-4" style="margin-bottom: 5rem;">Back To Trends </a>
        </article>
    </div>
</main>
