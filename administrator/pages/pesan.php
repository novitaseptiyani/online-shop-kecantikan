<?php
$query = "SELECT * FROM pesan ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<main>
    <div class="container">
        <h2 class="mb-4">Daftar Pesan</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengirim</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Isi Pesan</th>
                        <th style="width: 120px;">Tanggal</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($pesan = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($pesan['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pesan['nama_pengirim']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pesan['email_pengirim']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($pesan['subjek']) ?></td>
                                <td class="text-center"><?= nl2br(htmlspecialchars($pesan['isi_pesan'])) ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($pesan['tanggal_kirim'])) ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <a href="delete/delete_pesan.php?id=<?= $pesan['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pesan ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada pesan yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> </div>
</main>