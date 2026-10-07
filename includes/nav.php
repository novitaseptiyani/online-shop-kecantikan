<header class="bg-light py-3">
  <div class="container text-center">
    <a href="index.php?page=home" class="navbar-header mx-auto">
      VeeBeauté
    </a>
  </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container d-flex justify-content-between">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav"> 
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=home">Home</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=yourskin">Your Skin</a></li>

        <li class="nav-item dropdown me-3">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBrand" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Brand
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownBrand">
            <li><a class="dropdown-item" href="index.php?page=skincare">Skincare</a></li>
            <li><a class="dropdown-item" href="index.php?page=makeup">Makeup</a></li>
          </ul>
        </li>

        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=berita">Trends</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=galeri">Inspiration</a></li>
        <li class="nav-item me-3"><a class="nav-link" href="index.php?page=tentang">About Us</a></li>
      </ul>
    </div>
    
    <?php 
    if (isset($_SESSION['user_id'])): 
    ?>
      <span class="nav-item me-3 d-flex align-items-center">
          Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!
      </span>
      <a href="index.php?page=logout" class="icon-btn" title="Logout">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    <?php else: 
    ?>
      <a href="index.php?page=login" class="icon-btn" title="Account">
        <i class="fas fa-user"></i> 
      </a>
    <?php endif; ?>
  </div>
</nav>
