<!-- menu.php - 12 grid navbar -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-flower1 me-2"></i>My Web – Hani
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
        <li class="nav-item">
          <a class="nav-link <?= ($page=='home')?'active':'' ?>" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='about')?'active':'' ?>" href="index.php?page=about">About Me</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='contact')?'active':'' ?>" href="index.php?page=contact">Contact Me</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array($page,['level','studies'])?'active':'' ?>" href="#" data-bs-toggle="dropdown">
            My Studies
          </a>
          <ul class="dropdown-menu shadow border-0" style="border-radius:12px;">
            <li>
              <a class="dropdown-item <?= ($page=='level')?'active':'' ?>" href="index.php?page=level">
                <i class="bi bi-list-ol me-2" style="color:var(--pink-mid)"></i>Level
              </a>
            </li>
            <li>
              <a class="dropdown-item <?= ($page=='studies')?'active':'' ?>" href="index.php?page=studies">
                <i class="bi bi-book me-2" style="color:var(--pink-mid)"></i>Studies
              </a>
            </li>
          </ul>
        </li>
        <?php if (!isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='login')?'active':'' ?>" href="index.php?page=login">
            <i class="bi bi-box-arrow-in-right me-1"></i>Login
          </a>
        </li>
        <?php else: ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['user']) ?>
            <span class="badge ms-1" style="background:var(--pink-light);color:var(--pink-deep);font-size:.7rem;">
              <?= htmlspecialchars($_SESSION['role'] ?? 'User') ?>
            </span>
          </a>
          <ul class="dropdown-menu shadow border-0" style="border-radius:12px;">
            <li>
              <a class="dropdown-item text-danger" href="index.php?action=logout">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
      <form class="d-flex gap-2" method="GET" action="index.php">
        <input name="search" class="form-control" type="search" placeholder="Search..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"/>
        <button class="btn btn-search" type="submit"><i class="bi bi-search"></i> Search</button>
      </form>
    </div>
  </div>
</nav>
