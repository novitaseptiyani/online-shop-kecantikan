<?php
session_start();

include '../../includes/dbconnect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "SELECT gambar FROM produk WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $produk = mysqli_fetch_assoc($result);

    if ($produk) {
        if (!empty($produk['gambar'])) {
            $file_path = __DIR__ . '/../../assets/images/Produk/' . $produk['gambar'];
            
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../index.php?page=produk&msg=delete');
            exit;
        } else {
            header('Location: ../index.php?page=produk&msg=error');
            exit;
        }
    } else {
        header('Location: ../index.php?page=produk?msg=notfound');
        exit;
    }
} else {
    header('Location: ../index.php?page=produk');
    exit;
}
?>