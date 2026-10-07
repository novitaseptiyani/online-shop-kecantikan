<header class="bg-light py-3">
  <div class="container text-center">
    <a href="index.php?page=dashboard" class="navbar-header mx-auto">
      VeeBeauté
    </a>
  </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container d-flex justify-content-between">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentAdmin" 
            aria-controls="navbarSupportedContentAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContentAdmin">
      <ul class="navbar-nav"> 
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=dashboard">Dashboard</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=produk">Product</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=brand">Brand</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=pemesanan">Orders</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=berita">Trends</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=galeri">Inspiration</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=pesan">Messages</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=users">Account</a></li>
      </ul>

      <div class="d-flex align-items-center">
        <a class="nav-link d-flex align-items-center" href="../index.php?page=logout" title="Logout">
          <span class="me-1">(<?= htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>)</span> <i class="fas fa-sign-out-alt"></i> 
        </a>
        </div>
    </div> 
  </div>
</nav>