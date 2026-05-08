<?php
// pages/register.php
if (isset($_SESSION['user'])) {
    header('Location: index.php?page=home');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username     = trim($_POST['username'] ?? '');
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $password     = $_POST['password'] ?? '';
    $konfirmasi   = $_POST['konfirmasi'] ?? '';

    if ($username === '' || $nama_lengkap === '' || $password === '') {
        $error = 'Semua field wajib diisi! ⚠️';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter! ⚠️';
    } elseif ($password !== $konfirmasi) {
        $error = 'Konfirmasi password tidak cocok! ⚠️';
    } else {
        $cek = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $cek->execute([$username]);
        if ($cek->fetch()) {
            $error = 'Username sudah digunakan! ⚠️';
        } else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $ins  = $pdo->prepare("INSERT INTO users (username, password, nama_lengkap, role, created_at) VALUES (?, ?, ?, 'user', NOW())");
            $ins->execute([$username, $hash, $nama_lengkap]);
            $_SESSION['flash'] = 'Registrasi berhasil! Silakan login 🌸';
            header('Location: index.php?page=login');
            exit;
        }
    }
}
?>

<div class="main-card card">
  <div class="section-header"><i class="bi bi-person-plus-fill me-2"></i>Daftar Akun</div>
  <div class="card-body p-5">
    <div class="login-box">
      <div class="text-center mb-4">
        <div style="font-size:3.5rem;line-height:1">✨</div>
        <h4 class="pink-title mt-2">Buat Akun Baru</h4>
        <p class="text-muted small">Daftar untuk bergabung di My Web – Hani</p>
      </div>

      <?php if ($error): ?>
      <div class="alert alert-danger text-center rounded-3 py-2">
        <i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="index.php?page=register">
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-person-badge me-1"></i>Nama Lengkap
          </label>
          <input type="text" name="nama_lengkap" class="form-control"
                 placeholder="Masukkan nama lengkap..."
                 value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>" required/>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-person me-1"></i>Username
          </label>
          <input type="text" name="username" class="form-control"
                 placeholder="Masukkan username..."
                 value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required/>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-lock me-1"></i>Password
          </label>
          <div class="input-group">
            <input type="password" name="password" id="passInput"
                   class="form-control" placeholder="Minimal 6 karakter..." required/>
            <button type="button" class="btn btn-outline-secondary"
                    onclick="togglePass('passInput','eyeIcon1')">
              <i class="bi bi-eye" id="eyeIcon1"></i>
            </button>
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label fw-bold" style="color:var(--pink-deep)">
            <i class="bi bi-lock-fill me-1"></i>Konfirmasi Password
          </label>
          <div class="input-group">
            <input type="password" name="konfirmasi" id="passInput2"
                   class="form-control" placeholder="Ulangi password..." required/>
            <button type="button" class="btn btn-outline-secondary"
                    onclick="togglePass('passInput2','eyeIcon2')">
              <i class="bi bi-eye" id="eyeIcon2"></i>
            </button>
          </div>
        </div>
        <button type="submit" class="btn btn-pink w-100 py-2">
          <i class="bi bi-person-check me-2"></i>Daftar Sekarang
        </button>
      </form>

      <hr class="my-4" style="border-color:var(--pink-light)"/>

      <p class="text-center text-muted small mb-2">
        Sudah punya akun?
      </p>
      <a href="index.php?page=login" class="btn w-100 py-2"
         style="border:1px solid var(--pink-mid);color:var(--pink-deep);border-radius:10px;">
        <i class="bi bi-box-arrow-in-right me-2"></i>Login di Sini
      </a>

    </div>
  </div>
</div>

<script>
function togglePass(inputId, iconId) {
  const input = document.getElementById(inputId);
  const icon  = document.getElementById(iconId);
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'bi bi-eye-slash';
  } else {
    input.type = 'password';
    icon.className = 'bi bi-eye';
  }
}
</script>