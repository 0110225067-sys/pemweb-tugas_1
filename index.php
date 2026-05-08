<?php
ob_start();
// ============================================
//  index.php – Main Router
//  Personal Homepage Hani
// ============================================

session_start();
require_once 'includes/database.php';
// ============================================
//  index.php – Main Router
//  Personal Homepage Hani
// ============================================


// ===== LOGOUT =====
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php?page=home');
    exit;
}

// ===== PAGE ROUTING =====
$page = $_GET['page'] ?? 'home';
$allowed_pages = ['home','about','contact','level','studies','login','register'];
if (!in_array($page, $allowed_pages)) $page = 'home';

// ===== AUTH GUARD (CRUD) =====
$protected = ['level','studies'];
if (in_array($page, $protected) && !isset($_SESSION['user'])) {
    $_SESSION['flash'] = 'Anda harus login terlebih dahulu! 🔒';
    header('Location: index.php?page=login');
    exit;
}

// ===== SEARCH REDIRECT =====
if (isset($_GET['search']) && $_GET['search'] !== '') {
    $s = strtolower(trim($_GET['search']));
    $map = ['home'=>'home','about'=>'about','contact'=>'contact','level'=>'level','studies'=>'studies','login'=>'login','register'=>'register'];
    foreach ($map as $k => $v) {
        if (strpos($s,$k) !== false) { header("Location: index.php?page=$v"); exit; }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Web – Hani | <?= ucfirst($page) ?></title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
  <!-- Custom CSS -->
  <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>

<!-- HEADER: 12 grid – carousel -->
<?php include 'includes/header.php'; ?>

<!-- MENU: 12 grid – navbar -->
<?php include 'includes/menu.php'; ?>

<!-- Flash message -->
<?php if (isset($_SESSION['flash'])): ?>
<div class="container-fluid px-4 pt-3">
  <div class="alert alert-warning alert-dismissible fade show rounded-3" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i><?= $_SESSION['flash'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
</div>
<?php unset($_SESSION['flash']); endif; ?>

<!-- LAYOUT: sidebar + main -->
<div class="container-fluid px-4 py-4">
  <div class="row g-4">

    <!-- MAIN CONTENT: 9 grid -->
    <div class="col-lg-9">
      <?php include "pages/{$page}.php"; ?>
    </div>

    <!-- SIDEBAR: 3 grid -->
    <div class="col-lg-3">
      <?php include 'includes/sidebar.php'; ?>
    </div>

  </div>
</div>

<!-- FOOTER: 12 grid – alert -->
<?php include 'includes/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>