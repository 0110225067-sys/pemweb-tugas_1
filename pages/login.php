<?php
// pages/login.php
if (isset($_SESSION['user'])) {
    header('Location: index.php?page=home');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user']    = $user['username'];
        $_SESSION['role']    = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header('Location: index.php?page=level');
        } else {
            header('Location: index.php?page=home');
        }
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<div class="main-card card">
  <div class="section-header"><i class="bi bi-lock-fill me-2"></i>Login</div>
  <div class="card-body p-5">
    <div class="login-box">
      <div class="text-center mb-4">
        <div style="font-size:3.5rem;line-height:1">🌸</div>
        <h4 class="pink-title mt-2">Selamat Datang!</h4>
        <p class="text-muted small">Silakan login untuk masuk ke website</p>
      </div>

      <?php if ($error): ?>
      <div class="alert alert-danger text-center rounded-3 py-2">
        <i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
      </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['flash'])): ?>
      <div class="alert alert-success text-center rounded-3 py-2">
        <i class="bi bi-check-circle me-2"></i><?= $_SESSION['flash'] ?>
        <?php unset($_SESSION['flash']); ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="index.php?page=login">
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-person me-1"></i>Username
          </label>
          <input type="text" name="username" class="form-control"
                 placeholder="Masukkan username" required
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"/>
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-lock me-1"></i>Password
          </label>
          <div class="input-group">
            <input type="password" name="password" id="passInput"
                   class="form-control" placeholder="Masukkan password" required/>
            <button type="button" class="btn btn-outline-secondary"
                    onclick="togglePass()">
              <i class="bi bi-eye" id="eyeIcon"></i>
            </button>
          </div>
        </div>
        <button type="submit" class="btn btn-pink w-100 py-2">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </form>

      <hr class="my-4" style="border-color:var(--pink-light)"/>

      <p class="text-center text-muted small mb-2">
        Belum punya akun?
      </p>
      <a href="index.php?page=register" class="btn w-100 py-2"
         style="border:1px solid var(--pink-mid);color:var(--pink-deep);border-radius:10px;">
        <i class="bi bi-person-plus me-2"></i>Daftar Akun Baru
      </a>

      <p class="text-center text-muted small mt-3 mb-0">
        <i class="bi bi-info-circle me-1"></i>
        <strong>Hani</strong> <strong>Septiani 🌸</strong>
      </p>
    </div>
  </div>
</div>

<script>
function togglePass() {
  const input = document.getElementById('passInput');
  const icon  = document.getElementById('eyeIcon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'bi bi-eye-slash';
  } else {
    input.type = 'password';
    icon.className = 'bi bi-eye';
  }
}
</script>