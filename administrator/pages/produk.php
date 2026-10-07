<?php

$query = "SELECT produk.*, brand.nama_brand, kategori_produk.nama_kategori 
          FROM produk 
          JOIN brand ON produk.brand_id = brand.id 
          JOIN kategori_produk ON produk.kategori_id = kategori_produk.id 
          ORDER BY produk.id DESC";
$result = mysqli_query($conn, $query);

$brandQuery = mysqli_query($conn, "SELECT * FROM brand ORDER BY nama_brand");
$kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY nama_kategori");

$brandList = [];
while ($brand = mysqli_fetch_assoc($brandQuery)) {
    $brandList[] = $brand;
}

$kategoriList = [];
while ($kategori = mysqli_fetch_assoc($kategoriQuery)) {
    $kategoriList[] = $kategori;
}

function renderBrandOptions($brandList, $selectedId = null) {
    $options = '<option value="">-- Pilih Brand --</option>';
    foreach ($brandList as $brand) {
        $selected = ($brand['id'] == $selectedId) ? 'selected' : '';
        $options .= '<option value="' . $brand['id'] . '" ' . $selected . '>' . htmlspecialchars($brand['nama_brand']) . '</option>';
    }
    return $options;
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
        <h2>Daftar Produk</h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-skin" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th style="width: 220px;">Nama Produk</th>
                        <th style="width: 150px;">Brand</th>
                        <th style="width: 90px;">Kategori</th>
                        <th style="width: 120px;">Harga</th>
                        <th>Deskripsi</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($produk = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($produk['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($produk['nama_produk']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($produk['nama_brand']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($produk['nama_kategori']) ?></td>
                                <td class="text-center">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                <td class="text-justify"><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $produk['id'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <a href="delete/delete_produk.php?id=<?= $produk['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEdit<?= $produk['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $produk['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="edit/edit_produk.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label>Nama Produk</label>
                                                    <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Brand</label>
                                                    <select name="brand_id" class="form-control" required>
                                                        <?= renderBrandOptions($brandList, $produk['brand_id']) ?>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Kategori</label>
                                                    <select name="kategori_id" class="form-control" required>
                                                        <?= renderKategoriOptions($kategoriList, $produk['kategori_id']) ?>
                                                    </select>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Harga</label>
                                                    <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label>Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
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
                            <td colspan="7" class="text-center">Belum ada produk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="tambah/tambah_produk.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>
                            <div class="mb-4">
                                <label>Brand</label>
                                <select name="brand_id" class="form-control" required>
                                    <?= renderBrandOptions($brandList) ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control" required>
                                    <?= renderKategoriOptions($kategoriList) ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" required>
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