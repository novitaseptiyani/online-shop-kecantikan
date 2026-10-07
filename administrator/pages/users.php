<?php
$query = "SELECT * FROM user ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<main>
    <div class="container">
        <h2 class="mb-4">Daftar Akun</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($user = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo isset($user['tanggal']) ? date('d-m-Y', strtotime($user['tanggal'])) : '-';
                                    ?>
                                </td>
                                <td>
                                    <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2">
                                        <a href="delete/delete_users.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus akun ini?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada akun yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> </div>
</main>