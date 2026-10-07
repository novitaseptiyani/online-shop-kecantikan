<?php
session_start();

include '../../includes/dbconnect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "SELECT gambar FROM galeri WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $galeri = mysqli_fetch_assoc($result);

    if ($galeri) {
        if (!empty($galeri['gambar'])) {
            $file_path = __DIR__ . '/../../assets/images/galeri/' . $galeri['gambar'];
            
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $stmt = mysqli_prepare($conn, "DELETE FROM galeri WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../index.php?page=galeri&msg=delete');
            exit;
        } else {
            header('Location: ../index.php?page=galeri&msg=error');
            exit;
        }
    } else {
        header('Location: ../index.php?page=galeri&msg=notfound');
        exit;
    }
} else {
    header('Location: ../index.php?page=galeri');
    exit;
}
?>