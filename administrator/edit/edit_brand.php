<?php
session_start();

include '../../includes/dbconnect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $nama_brand = $_POST['nama_brand']; 
    $kategori_id = (int) $_POST['kategori_id']; 
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE brand 
              SET nama_brand = ?, kategori_id = ?, deskripsi = ? 
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        header('Location: ../index.php?page=brand&msg=edit_error&detail=' . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssi", $nama_brand, $kategori_id, $deskripsi, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?page=brand&msg=update_sukses");
        exit();
    } else {
        header("Location: ../index.php?page=brand&msg=update_error&detail=" . urlencode(mysqli_stmt_error($stmt)));
        exit();
    }

    mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php?page=brand");
    exit();
}
?>