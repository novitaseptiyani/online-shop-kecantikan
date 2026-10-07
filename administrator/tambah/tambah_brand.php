<?php
session_start();

include '../../includes/dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_brand = $_POST['nama_brand'];
    $kategori_id = (int) $_POST['kategori_id'];
    $deskripsi = $_POST['deskripsi']; 

    $query = "INSERT INTO brand (nama_brand, kategori_id, deskripsi) 
              VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        header('Location: ../index.php?page=brand&msg=tambah_error&detail=' . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sis", $nama_brand, $kategori_id, $deskripsi);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?page=brand&msg=tambah_sukses");
        exit();
    } else {
        header("Location: ../index.php?page=brand&msg=tambah_error&detail=" . urlencode(mysqli_stmt_error($stmt)));
        exit();
    }

    mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php?page=brand");
    exit();
}
?>