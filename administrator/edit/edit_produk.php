<?php
session_start();

include '../../includes/dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $nama_produk = $_POST['nama_produk']; 
    $brand_id = (int) $_POST['brand_id'];
    $kategori_id = (int) $_POST['kategori_id'];
    $deskripsi = $_POST['deskripsi']; 
    $harga = (float) $_POST['harga'];

    $query = "UPDATE produk 
              SET nama_produk = ?, brand_id = ?, kategori_id = ?, deskripsi = ?, harga = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        header('Location: ../index.php?page=produk&msg=edit_error&detail=' . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "siidsi", $nama_produk, $brand_id, $kategori_id, $deskripsi, $harga, $id);

    mysqli_stmt_bind_param($stmt, "siisdi", $nama_produk, $brand_id, $kategori_id, $deskripsi, $harga, $id);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: ../index.php?page=produk&msg=update_sukses");
        exit();
    } else {
        header("Location: ../index.php?page=produk&msg=update_error&detail=" . urlencode(mysqli_stmt_error($stmt)));
        exit();
    }

    mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php?page=produk");
    exit();
}
?>
