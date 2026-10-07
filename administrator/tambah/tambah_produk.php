<?php
session_start();

include '../../includes/dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $brand_id = (int) $_POST['brand_id']; 
    $kategori_id = (int) $_POST['kategori_id'];
    $deskripsi = $_POST['deskripsi']; 
    $harga = (float) $_POST['harga'];

    $query = "INSERT INTO produk (nama_produk, brand_id, kategori_id, deskripsi, harga)
              VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        header('Location: ../index.php?page=produk&msg=tambah_error&detail=' . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "siisd", $nama_produk, $brand_id, $kategori_id, $deskripsi, $harga);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?page=produk&msg=tambah_sukses");
        exit();
    } else {
        header("Location: ../index.php?page=produk&msg=tambah_error&detail=" . urlencode(mysqli_stmt_error($stmt)));
        exit();
    }

    mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php?page=produk");
    exit();
}
?>