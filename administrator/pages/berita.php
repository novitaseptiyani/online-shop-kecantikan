<?php
$query = "SELECT * FROM berita ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<main>
    <div class="container">
        <h2 class="mb-4">Daftar Berita</h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-skin" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
        </div>
        
        <div class="table-responsive"> 
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 200px;">Judul</th>
                        <th>Isi Berita</th>
                        <th style="width: 130px;">Tanggal</th>
                        <th>Gambar</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($berita = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($berita['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($berita['judul']) ?></td>
                                <td class="text-justify"><?= nl2br(htmlspecialchars($berita['isi'])) ?></td>
                                <td class="text-center">
                                    <?= date('d-m-Y', strtotime($berita['tanggal'])) ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($berita['gambar'])): ?>
                                        <img src="/412023015_NOVITA_SEPTIYANI/assets/images/berita/<?= htmlspecialchars($berita['gambar']) ?>" 
                                             alt="Gambar Berita" class="img-fluid" style="max-height: 80px; width: auto;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $berita['id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <a href="delete/delete_berita.php?id=<?= $berita['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus berita ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $berita['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $berita['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="edit/edit_berita.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $berita['id'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="modalEditLabel<?= $berita['id'] ?>">Edit Berita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label>Judul</label>
                                                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($berita['judul']) ?>" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Isi Berita</label>
                                                    <textarea name="isi" class="form-control" required><?= htmlspecialchars($berita['isi']) ?></textarea>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Gambar Baru (kosongkan jika tidak diubah)</label>
                                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                                </div>
                                                <div class="mb-4">
                                                    <label>Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control" value="<?= $berita['tanggal'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada berita yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="tambah/tambah_berita.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label>Isi Berita</label>
                                <textarea name="isi" class="form-control" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mb-4">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>