<?php

$total_orders = 0;
$query_total_orders = "SELECT COUNT(id) AS count FROM pemesanan";
$result_total_orders = mysqli_query($conn, $query_total_orders);
if ($result_total_orders) {
    $data_total_orders = mysqli_fetch_assoc($result_total_orders);
    $total_orders = $data_total_orders['count'];
} else {

}

$total_products = 0;
$query_total_products = "SELECT COUNT(id) AS count FROM produk";
$result_total_products = mysqli_query($conn, $query_total_products);
if ($result_total_products) {
    $data_total_products = mysqli_fetch_assoc($result_total_products);
    $total_products = $data_total_products['count'];
} else {

}

$total_users = 0;
$query_total_users = "SELECT COUNT(id) AS count FROM user";
$result_total_users = mysqli_query($conn, $query_total_users);
if ($result_total_users) {
    $data_total_users = mysqli_fetch_assoc($result_total_users);
    $total_users = $data_total_users['count'];
} else {

}

$query_unread_messages = "SELECT COUNT(id) AS count FROM pesan";
$result_unread_messages = mysqli_query($conn, $query_unread_messages);
if ($result_unread_messages) {
    $data_unread_messages = mysqli_fetch_assoc($result_unread_messages);
    $unread_messages = $data_unread_messages['count'];
} else {

}

$latest_orders = [];
$query_latest_orders = "SELECT id, nama_pembeli, tanggal, metode_pembayaran FROM pemesanan ORDER BY tanggal DESC LIMIT 5";
$result_latest_orders = mysqli_query($conn, $query_latest_orders);
if ($result_latest_orders) {
    while ($row = mysqli_fetch_assoc($result_latest_orders)) {
        $latest_orders[] = $row;
    }
} else {

}

$latest_messages = [];
$query_latest_messages = "SELECT id, nama_pengirim, subjek, tanggal_kirim FROM pesan ORDER BY tanggal_kirim DESC LIMIT 5";
$result_latest_messages = mysqli_query($conn, $query_latest_messages);
if ($result_latest_messages) {
    while ($row = mysqli_fetch_assoc($result_latest_messages)) {
        $latest_messages[] = $row;
    }
} else {

}

$monthly_orders_data = [];
$chart_labels = []; 
$chart_values = [];

$query_monthly_orders = "
    SELECT
        DATE_FORMAT(tanggal, '%Y-%m') AS month_year,
        COUNT(id) AS total_orders
    FROM pemesanan
    GROUP BY month_year
    ORDER BY month_year ASC
    LIMIT 6; 
";
$result_monthly_orders = mysqli_query($conn, $query_monthly_orders);

if ($result_monthly_orders) {
    while ($row = mysqli_fetch_assoc($result_monthly_orders)) {
        $timestamp = strtotime($row['month_year'] . '-01'); 
        $chart_labels[] = date('M Y', $timestamp); 
        $chart_values[] = $row['total_orders'];
    }
} else {

}

?>

<main class="pt-5">
    <div class="container-fluid">
        <h3 class="fw-bold text-center" style="margin-bottom: 4rem;">Dashboard Admin VeeBeauté</h3>

        <div class="row mt-4" style="margin-bottom: 2rem;">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                            <div class="col">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pesanan</div>
                                <div class="h5 mb-0 font-weight-bold">
                                    <?= $total_orders; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x"></i>
                            </div>
                            <div class="col">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Produk</div>
                                <div class="h5 mb-0 font-weight-bold">
                                    <?= $total_products; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <div class="col">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengguna</div>
                                <div class="h5 mb-0 font-weight-bold">
                                    <?= $total_users; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x"></i>
                            </div>
                            <div class="col">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pesan</div>
                                <div class="h5 mb-0 font-weight-bold">
                                    <?= $unread_messages; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tren Pesanan Bulanan</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas> 
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3">Pesanan Terbaru</h5>
                        <ul class="list-group list-group-flush">
                            <?php if (empty($latest_orders)): ?>
                                <li class="list-group-item text-muted">Belum ada pesanan terbaru.</li>
                            <?php else: ?>
                                <?php foreach ($latest_orders as $order): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Order #<?= htmlspecialchars($order['id']); ?></strong> oleh <?= htmlspecialchars($order['nama_pembeli']); ?>
                                            <small class="d-block text-muted"><?= date('d M Y, H:i', strtotime($order['tanggal'])); ?></small>
                                        </div>
                                        <a href="?page=pemesanan&id=<?= htmlspecialchars($order['id']); ?>" class="btn btn-sm btn-outline-info">Detail</a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>

                        <hr class="my-4"> <h5 class="mb-3">Pesan Terbaru</h5>
                        <ul class="list-group list-group-flush">
                            <?php if (empty($latest_messages)): ?>
                                <li class="list-group-item text-muted">Belum ada pesan terbaru.</li>
                            <?php else: ?>
                                <?php foreach ($latest_messages as $message): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong><?= htmlspecialchars($message['subjek']); ?></strong> dari <?= htmlspecialchars($message['nama_pengirim']); ?>
                                            <small class="d-block text-muted"><?= date('d M Y, H:i', strtotime($message['tanggal_kirim'])); ?></small>
                                        </div>
                                        <a href="?page=pesan&id=<?= htmlspecialchars($message['id']); ?>" class="btn btn-sm btn-outline-info">Lihat</a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
