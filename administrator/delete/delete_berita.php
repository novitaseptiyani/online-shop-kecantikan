<?php
session_start();

include '../../includes/dbconnect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "SELECT gambar FROM berita WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $berita = mysqli_fetch_assoc($result);

    if ($berita) {
        if (!empty($berita['gambar'])) {
            $file_path = __DIR__ . '/../../assets/images/Berita/' . $berita['gambar'];
            
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM berita WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../index.php?page=berita&msg=delete_success');
            exit;
        } else {
            header('Location: ../index.php?page=berita&msg=delete_error');
            exit;
        }
    } else {
        header('Location: ../index.php?page=berita&msg=notfound');
        exit;
    }
} else {
    header('Location: ../index.php?page=berita&msg=invalid_id');
    exit;
}
?>
