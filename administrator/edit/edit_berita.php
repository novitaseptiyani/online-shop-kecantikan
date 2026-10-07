<?php
session_start(); 

include '../../includes/dbconnect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal']; 

    $stmt = null;

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];

        $upload_dir = __DIR__ . '/../../assets/images/Berita/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); 
        }

        $target_file = $upload_dir . $gambar; 
        
        $stmt_old_gambar = mysqli_prepare($conn, "SELECT gambar FROM berita WHERE id = ?");
        mysqli_stmt_bind_param($stmt_old_gambar, "i", $id);
        mysqli_stmt_execute($stmt_old_gambar);
        $result_old_gambar = mysqli_stmt_get_result($stmt_old_gambar);
        $old_berita = mysqli_fetch_assoc($result_old_gambar);

        if ($old_berita && !empty($old_berita['gambar'])) {
            $old_file_path = $upload_dir . $old_berita['gambar'];
            if (file_exists($old_file_path) && $old_berita['gambar'] !== $gambar) { 
                unlink($old_file_path);
            }
        }

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $query = "UPDATE berita SET judul=?, isi=?, tanggal=?, gambar=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $judul, $isi, $tanggal, $gambar, $id);
        } else {
            header('Location: ../index.php?page=berita&msg=upload_error');
            exit;
        }

    } else {
        $query = "UPDATE berita SET judul=?, isi=?, tanggal=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $judul, $isi, $tanggal, $id);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?page=berita&msg=edit_success");
        exit;
    } else {
        $error_message = $stmt ? mysqli_stmt_error($stmt) : "Unknown error or statement not prepared.";
        header("Location: ../index.php?page=berita&msg=edit_error&detail=" . urlencode($error_message));
        exit;
    }
} else {
    header("Location: ../index.php?page=berita");
    exit;
}
?>