<?php

session_start(); 

$includes_path = "includes/";

$page = 'home'; 

if (isset($_GET['page'])) {
    $temp_page = strtolower(trim($_GET['page']));
    if (preg_match('/^[a-z0-9_]+$/', $temp_page)) { 
        $page = $temp_page;
    }
}

include($includes_path . "dbconnect.php"); 
include($includes_path . "header.php");
include($includes_path . "nav.php"); 

?>

<body>
    <main>
        <?php
        $content_file = "pages/home.php"; 

        switch ($page) {
            case 'home':
                $content_file = "pages/home.php";
                break;
            case 'berita':
                $content_file = "pages/berita.php";
                break;
            case 'berita_detail':
                $content_file = "pages/berita_detail.php";
                break;
            case 'galeri':
                $content_file = "pages/galeri.php";
                break;
            case 'tentang':
                $content_file = "pages/tentang.php";
                break;
            case 'makeup':
                $content_file = "pages/makeup.php";
                break;
            case 'skincare':
                $content_file = "pages/skincare.php";
                break;
            case 'checkout':
                $content_file = "pages/checkout.php";
                break;
            case 'prosess_checkout':
                $content_file = "pages/prosess_checkout.php";
                break;
            case 'search':
                $content_file = "pages/search.php";
                break;
            case 'yourskin':
                $content_file = "pages/yourskin.php";
                break;
            case 'login': 
                $content_file = "pages/login_register.php";
                break;
            case 'logout': 
                $content_file = "pages/logout.php";
                break;

            default:
                $content_file = "pages/home.php"; 
                break;
        }

        if (file_exists($content_file)) {
                include($content_file);

        } else {
            echo "<h2>Oops! Halaman tidak ditemukan.</h2>";
        }
        ?>
    </main>
 
    <?php

    include($includes_path . "footer.php");
    ?>
</body>
</html>