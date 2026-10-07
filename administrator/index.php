<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login_register.php");
    exit();
}

$includes_root_path = "../includes/";

include($includes_root_path . "dbconnect.php");
include($includes_root_path . "header.php");

?>

<body>
    <?php
    include("nav.php");
    ?>

    <div class="admin-main-content">
        <?php
        $admin_content_file = "pages/dashboard.php"; 

        if (isset($_GET['page'])) {
            $page = strtolower(trim($_GET['page']));

            switch ($page) {
                case 'berita':
                    $admin_content_file = "pages/berita.php";
                    break;
                case 'brand':
                    $admin_content_file = "pages/brand.php";
                    break;
                case 'galeri':
                    $admin_content_file = "pages/galeri.php";
                    break;
                case 'produk':
                    $admin_content_file = "pages/produk.php";
                    break;
                case 'users':
                    $admin_content_file = "pages/users.php";
                    break;
                case 'pemesanan':
                    $admin_content_file = "pages/pemesanan.php";
                    break;
                case 'pesan':
                    $admin_content_file = "pages/pesan.php";
                    break;
                case 'tambah_berita':
                    $admin_content_file = "tambah/tambah_berita.php";
                    break;
                case 'edit_berita':
                    $admin_content_file = "edit/edit_berita.php";
                    break;
                default:
                    $admin_content_file = "pages/dashboard.php";
                    break;
            }
        }

        if (file_exists($admin_content_file)) {
            include($admin_content_file);
        } else {
            echo "<h3>Halaman Admin tidak ditemukan!</h3>";
        }
        ?>
    </div>

    <?php
    include($includes_root_path . "footer.php");
    ?>
</body>
</html>