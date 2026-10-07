<?php
$query = "SELECT * FROM pemesanan ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<main>
    <div class="container">
        <h2 class="mb-4">Daftar Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Produk ID</th>
                        <th>Nama Pembeli</th>
                        <th>Alamat</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($pemesanan = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($pemesanan['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pemesanan['produk_id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pemesanan['nama_pembeli']) ?></td>
                                <td class="text-center"><?= nl2br(htmlspecialchars($pemesanan['alamat'])) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pemesanan['metode_pembayaran']) ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($pemesanan['tanggal'])) ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <a href="delete/delete_pemesanan.php?id=<?= $pemesanan['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pesanan ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pemesanan yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> </div>
</main>