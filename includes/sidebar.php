<!-- sidebar.php - 3 grid, list group bootstrap -->
<div class="sidebar-card card mb-4">
  <div class="section-header">
    <i class="bi bi-grid-fill me-2"></i>Kategori
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item <?= ($page=='home')?'active-item':'' ?>">
      <a href="index.php?page=home" class="text-decoration-none d-block">
        <i class="bi bi-house-heart me-2"></i>Home
      </a>
    </li>
    <li class="list-group-item <?= ($page=='about')?'active-item':'' ?>">
      <a href="index.php?page=about" class="text-decoration-none d-block">
        <i class="bi bi-person-circle me-2"></i>About Me
      </a>
    </li>
    <li class="list-group-item <?= ($page=='contact')?'active-item':'' ?>">
      <a href="index.php?page=contact" class="text-decoration-none d-block">
        <i class="bi bi-envelope-heart me-2"></i>Contact Me
      </a>
    </li>
    <li class="list-group-item <?= ($page=='level')?'active-item':'' ?>">
      <a href="index.php?page=level" class="text-decoration-none d-block">
        <i class="bi bi-list-ol me-2"></i>Level
      </a>
    </li>
    <li class="list-group-item <?= ($page=='studies')?'active-item':'' ?>">
      <a href="index.php?page=studies" class="text-decoration-none d-block">
        <i class="bi bi-book me-2"></i>Studies
      </a>
    </li>
  </ul>
</div>

<div class="sidebar-card card mb-4">
  <div class="section-header"><i class="bi bi-person-badge me-2"></i>Profile</div>
  <div class="card-body text-center py-3">
    <img src="assets/IMG/foto_profil.jpg"
         class="rounded-circle mb-2"
         width="80" height="80"
         style="object-fit:cover;border:3px solid var(--pink-light)"/>
    <h6 class="pink-title mb-0">Hani Septiani🌸</h6>
    <p class="text-muted small mb-0">Mahasiswi Teknik Informatika</p>
  </div>
</div>

<div class="sidebar-card card">
  <div class="section-header"><i class="bi bi-quote me-2"></i>Quote</div>
  <div class="card-body" style="background:var(--pink-pastel)">
    <p class="fst-italic mb-1" style="color:var(--text-mid);font-size:.9rem;">
      "Kode yang baik adalah puisi yang bisa dijalankan mesin." 💻
    </p>
    <p class="text-end mb-0" style="color:var(--pink-light);font-size:.78rem;">— Hani</p>
  </div>
</div>
