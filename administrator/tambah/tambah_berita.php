<?php
session_start();

include '../../includes/dbconnect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];

        $upload_dir = __DIR__ . '/../../assets/images/Berita/'; 

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $target_file = $upload_dir . $gambar; 
        
        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            header('Location: ../index.php?page=berita&msg=upload_error');
            exit;
        }
    } else {
    }

    $query = "INSERT INTO berita (judul, isi, tanggal, gambar) VALUES (?, ?, ?, ?)"; 

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        header('Location: ../index.php?page=berita&msg=insert_error&detail=' . urlencode(mysqli_error($conn)));
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $judul, $isi, $tanggal, $gambar);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?page=berita&msg=tambah_sukses");
        exit();
    } else {
        header("Location: ../index.php?page=berita&msg=tambah_error&detail=" . urlencode(mysqli_stmt_error($stmt)));
        exit();
    }

    mysqli_stmt_close($stmt);

} else {
    header("Location: ../index.php?page=berita");
    exit;
}
?>
