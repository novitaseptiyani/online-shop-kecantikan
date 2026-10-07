<?php
$query = "SELECT * FROM brand ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$kategoriQuery = "SELECT * FROM kategori_produk ORDER BY id";
$kategoriResult = mysqli_query($conn, $kategoriQuery);

$kategoriList = [];
while ($kategori = mysqli_fetch_assoc($kategoriResult)) {
    $kategoriList[] = $kategori;
}

function renderKategoriOptions($kategoriList, $selectedId = null) {
    $options = '<option value="">-- Pilih Kategori --</option>';
    foreach ($kategoriList as $kategori) {
        $selected = ($kategori['id'] == $selectedId) ? 'selected' : '';
        $options .= '<option value="' . $kategori['id'] . '" ' . $selected . '>' . htmlspecialchars($kategori['nama_kategori']) . '</option>';
    }
    return $options;
}
?>

<main>
    <div class="container">
        <h2 class="mb-4">Daftar Brand</h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-skin" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th style="width: 150px;">Nama Brand</th>
                        <th style="width: 150px;">Kategori</th>
                        <th>Deskripsi</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($brand = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($brand['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($brand['nama_brand']) ?></td>
                                <td class="text-center">
                                    <?php
                                        foreach ($kategoriList as $kategori) {
                                            if ($kategori['id'] == $brand['kategori_id']) {
                                                echo htmlspecialchars($kategori['nama_kategori']);
                                                break;
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="text-justify"><?= nl2br(htmlspecialchars($brand['deskripsi'])) ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $brand['id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <a href="delete/delete_brand.php?id=<?= $brand['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus brand ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $brand['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $brand['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="edit/edit_brand.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $brand['id'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="modalEditLabel<?= $brand['id'] ?>">Edit Brand</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label>Nama Brand</label>
                                                    <input type="text" name="nama_brand" class="form-control" value="<?= htmlspecialchars($brand['nama_brand']) ?>" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="kategori_id">Kategori</label>
                                                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                        <?= renderKategoriOptions($kategoriList, $brand['kategori_id']) ?>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($brand['deskripsi']) ?></textarea>
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
                            <td colspan="6" class="text-center">Belum ada brand yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="tambah/tambah_brand.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label>Nama Brand</label>
                                <input type="text" name="nama_brand" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    <?= renderKategoriOptions($kategoriList) ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" required></textarea>
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