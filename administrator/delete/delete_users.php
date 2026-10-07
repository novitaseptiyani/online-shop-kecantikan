<?php
session_start();

include '../../includes/dbconnect.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($conn, "DELETE FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../index.php?page=users&msg=delete'); 
        exit;
    } else {
        header('Location: ../index.php?page=users&msg=error');
        exit;
    }
} else {
    header('Location: ../index.php?page=users');
    exit;
}
?>
