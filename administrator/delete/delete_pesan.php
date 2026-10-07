<?php
session_start();

include '../../includes/dbconnect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "DELETE FROM pesan WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../index.php?page=pesan&msg=delete');
        exit;
    } else {
        header('Location: ../index.php?page=pesan&msg=error');
        exit;
    }
} else {
    header('Location: ../index.php?page=pesan');
    exit;
}
?>