<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produk_id = intval($_POST['produk_id']);
    $nama_pembeli = mysqli_real_escape_string($conn, $_POST['nama_pembeli']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);

    if (empty($nama_pembeli) || empty($alamat) || empty($metode_pembayaran)) {
        header("Location: index.php?page=checkout&produk_id=$produk_id&status=error");
        exit;
    }

    $query = "INSERT INTO pemesanan (produk_id, nama_pembeli, alamat, metode_pembayaran) 
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isss", $produk_id, $nama_pembeli, $alamat, $metode_pembayaran);
    $exec = mysqli_stmt_execute($stmt);

    if ($exec) {
        header("Location: index.php?page=checkout&status=success&produk_id=$produk_id");
        exit;
    } else {
        header("Location: index.php?page=checkout&status=error&produk_id=$produk_id");
        exit;
    }
} else {
    header("Location: home.php");
    exit;
}
?>
