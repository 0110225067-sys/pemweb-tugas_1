<?php
// pages/studies.php
// Requires login - checked in index.php

// ─── Helper: Upload atau pakai nama file yang sudah ada ───────────────────────
function handleFotoSekolah($file, $namaManual, $fotoLama = null) {
    $folder = 'assets/img/';

    // Prioritas 1: Upload file baru dari komputer
    if (!empty($file['name']) && $file['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['hasil' => $fotoLama ?? '', 'error' => 'Tipe file tidak didukung.'];
        }
        if ($file['size'] > 2 * 1024 * 1024) {
            return ['hasil' => $fotoLama ?? '', 'error' => 'Ukuran file melebihi 2MB.'];
        }
        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $namaFile = time() . '_' . uniqid() . '.' . $ext;
        $tujuan   = $folder . $namaFile;

        if (!is_dir($folder)) mkdir($folder, 0755, true);

        if (move_uploaded_file($file['tmp_name'], $tujuan)) {
            // Hapus foto lama jika ada dan berbeda
            if ($fotoLama && $fotoLama !== $namaFile && file_exists($folder . $fotoLama)) {
                unlink($folder . $fotoLama);
            }
            return ['hasil' => $namaFile, 'error' => ''];
        }
        return ['hasil' => $fotoLama ?? '', 'error' => 'Gagal menyimpan file.'];
    }

    // Prioritas 2: Nama file manual yang sudah ada di assets/img/
    $namaManual = trim($namaManual);
    if (!empty($namaManual)) {
        // Boleh isi lengkap "mtsn.jpg" atau path "assets/img/mtsn.jpg"
        $namaManual = basename($namaManual); // ambil nama file saja
        if (file_exists($folder . $namaManual)) {
            return ['hasil' => $namaManual, 'error' => ''];
        }
        return ['hasil' => $fotoLama ?? '', 'error' => "File '$namaManual' tidak ditemukan di $folder."];
    }

    // Tidak ada perubahan
    return ['hasil' => $fotoLama ?? '', 'error' => ''];
}

// ─── Proses POST ──────────────────────────────────────────────────────────────
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    if ($_POST['action'] === 'add') {
        $nama        = trim($_POST['nama'] ?? '');
        $idlevel     = (int)($_POST['idlevel'] ?? 0);
        $keterangan  = trim($_POST['keterangan'] ?? '');
        $tahun_lulus = (int)($_POST['tahun_lulus'] ?? 0);

        $fotoResult  = handleFotoSekolah(
            $_FILES['foto_sekolah'] ?? [],
            $_POST['nama_foto_manual'] ?? ''
        );
        $foto_sekolah = $fotoResult['hasil'];
        $fotoError    = $fotoResult['error'];

        if ($nama && $idlevel) {
            $stmt = $pdo->prepare("INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES (?,?,?,?,?)");
            $stmt->execute([$nama, $idlevel, $keterangan, $tahun_lulus, $foto_sekolah]);
            $msg  = '<div class="alert alert-success rounded-3"><i class="bi bi-check-circle me-2"></i>Data berhasil ditambahkan!</div>';
            $msg .= $fotoError ? '<div class="alert alert-warning rounded-3"><i class="bi bi-exclamation-triangle me-2"></i>' . htmlspecialchars($fotoError) . '</div>' : '';
        }

    } elseif ($_POST['action'] === 'edit') {
        $id          = (int)$_POST['id'];
        $nama        = trim($_POST['nama'] ?? '');
        $idlevel     = (int)($_POST['idlevel'] ?? 0);
        $keterangan  = trim($_POST['keterangan'] ?? '');
        $tahun_lulus = (int)($_POST['tahun_lulus'] ?? 0);

        // Ambil foto lama dari DB
        $stmtLama = $pdo->prepare("SELECT foto_sekolah FROM studies WHERE id=?");
        $stmtLama->execute([$id]);
        $fotoLama = $stmtLama->fetchColumn();

        $fotoResult   = handleFotoSekolah(
            $_FILES['foto_sekolah'] ?? [],
            $_POST['nama_foto_manual'] ?? '',
            $fotoLama
        );
        $foto_sekolah = $fotoResult['hasil'];
        $fotoError    = $fotoResult['error'];

        if ($id && $nama) {
            $stmt = $pdo->prepare("UPDATE studies SET nama=?,idlevel=?,keterangan=?,tahun_lulus=?,foto_sekolah=? WHERE id=?");
            $stmt->execute([$nama, $idlevel, $keterangan, $tahun_lulus, $foto_sekolah, $id]);
            $msg  = '<div class="alert alert-info rounded-3"><i class="bi bi-pencil-check me-2"></i>Data berhasil diperbarui!</div>';
            $msg .= $fotoError ? '<div class="alert alert-warning rounded-3"><i class="bi bi-exclamation-triangle me-2"></i>' . htmlspecialchars($fotoError) . '</div>' : '';
        }

    } elseif ($_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        if ($id) {
            $pdo->prepare("DELETE FROM studies WHERE id=?")->execute([$id]);
            $msg = '<div class="alert alert-warning rounded-3"><i class="bi bi-trash me-2"></i>Data berhasil dihapus!</div>';
        }
    }
}

// ─── Ambil data ───────────────────────────────────────────────────────────────
$studies = $pdo->query("
    SELECT s.*, l.nama as level_nama 
    FROM studies s 
    LEFT JOIN level l ON s.idlevel = l.id 
    ORDER BY FIELD(l.nama, 'TK','SD','SMP','SMA','D3','S1','S2','S3'), s.tahun_lulus ASC
")->fetchAll();

$levels = $pdo->query("SELECT * FROM level ORDER BY id")->fetchAll();

$editItem = null;
if (isset($_GET['edit_studies'])) {
    $stmt = $pdo->prepare("SELECT * FROM studies WHERE id=?");
    $stmt->execute([(int)$_GET['edit_studies']]);
    $editItem = $stmt->fetch();
}
?>

<div class="main-card card">
  <div class="section-header"><i class="bi bi-book me-2"></i>Data Riwayat Pendidikan (Studies)</div>
  <div class="card-body p-4">

    <?= $msg ?>

    <!-- ── Form Tambah / Edit ───────────────────────────────────────────── -->
    <div class="p-4 mb-4 rounded-3" style="background:var(--pink-pale)">
      <h6 class="pink-title mb-3">
        <i class="bi bi-<?= $editItem ? 'pencil' : 'plus-circle' ?> me-2"></i>
        <?= $editItem ? 'Edit Data Studies' : 'Tambah Data Studies' ?>
      </h6>

      <form method="POST" action="index.php?page=studies" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editItem ? 'edit' : 'add' ?>"/>
        <?php if ($editItem): ?>
          <input type="hidden" name="id" value="<?= $editItem['id'] ?>"/>
        <?php endif; ?>

        <div class="row g-3">
          <!-- Nama Sekolah -->
          <div class="col-md-6">
            <label class="fw-bold" style="color:var(--pink-deep)">Nama Sekolah / Kampus</label>
            <input type="text" name="nama" class="form-control mt-1" placeholder="Nama institusi"
                   value="<?= htmlspecialchars($editItem['nama'] ?? '') ?>" required/>
          </div>

          <!-- Level -->
          <div class="col-md-6">
            <label class="fw-bold" style="color:var(--pink-deep)">Level Pendidikan</label>
            <select name="idlevel" class="form-select mt-1" required>
              <option value="">-- Pilih Level --</option>
              <?php foreach ($levels as $lv): ?>
              <option value="<?= $lv['id'] ?>" <?= (($editItem['idlevel'] ?? '') == $lv['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($lv['nama']) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Keterangan -->
          <div class="col-md-8">
            <label class="fw-bold" style="color:var(--pink-deep)">Keterangan (Jurusan, dll)</label>
            <input type="text" name="keterangan" class="form-control mt-1" placeholder="Contoh: IPA, Teknik Informatika"
                   value="<?= htmlspecialchars($editItem['keterangan'] ?? '') ?>"/>
          </div>

          <!-- Tahun Lulus -->
          <div class="col-md-4">
            <label class="fw-bold" style="color:var(--pink-deep)">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control mt-1" placeholder="2024" min="1990" max="2099"
                   value="<?= htmlspecialchars($editItem['tahun_lulus'] ?? '') ?>"/>
          </div>

          <!-- ── FOTO SEKOLAH ─────────────────────────────────────────── -->
          <div class="col-12">
            <label class="fw-bold" style="color:var(--pink-deep)">Foto Sekolah (opsional)</label>

            <?php if ($editItem && !empty($editItem['foto_sekolah'])): ?>
            <!-- Preview foto saat ini -->
            <div class="mb-2 d-flex align-items-center gap-2">
              <img src="assets/img/<?= htmlspecialchars($editItem['foto_sekolah']) ?>"
                   width="60" height="60"
                   style="object-fit:cover;border-radius:8px;border:2px solid var(--pink-light)"
                   alt="foto saat ini"
                   onerror="this.style.display='none'"/>
              <small class="text-muted">
                Foto saat ini: <code><?= htmlspecialchars($editItem['foto_sekolah']) ?></code>
              </small>
            </div>
            <?php endif; ?>

            <!-- Pilihan cara input foto -->
            <div class="border rounded-3 p-3 mt-1" style="background:#fff">

              <!-- Tab toggle -->
              <div class="d-flex gap-2 mb-3">
                <button type="button" class="btn btn-sm btn-pink" id="btnTabUpload"
                        onclick="switchTab('upload')">
                  <i class="bi bi-upload me-1"></i>Upload File
                </button>
                <button type="button" class="btn btn-sm btn-pink-outline" id="btnTabManual"
                        onclick="switchTab('manual')">
                  <i class="bi bi-file-earmark-image me-1"></i>Nama File (sudah ada)
                </button>
              </div>

              <!-- Tab Upload -->
              <div id="tabUpload">
                <input type="file" name="foto_sekolah" class="form-control" accept="image/*"
                       onchange="previewFoto(this)"/>
                <small class="text-muted">Upload file baru dari komputer. Format: JPG, PNG, GIF, WEBP. Maks 2MB.</small>
                <div id="fotoPreview" class="mt-2" style="display:none">
                  <img id="previewImg" src="" width="80" height="80"
                       style="object-fit:cover;border-radius:8px;border:2px solid var(--pink-light)" alt="preview"/>
                  <small class="text-muted ms-2">Preview</small>
                </div>
              </div>

              <!-- Tab Nama File Manual -->
              <div id="tabManual" style="display:none">
                <input type="text" name="nama_foto_manual" class="form-control"
                       placeholder="Contoh: mtsn.jpg atau nuri.png"
                       value=""/>
                <small class="text-muted">
                  Isi nama file yang sudah ada di folder <code>assets/img/</code>.
                  Contoh: <code>mtsn.jpg</code>, <code>sd_negeri.png</code>
                </small>
              </div>

            </div><!-- /border -->
          </div>
          <!-- ── END FOTO ─────────────────────────────────────────────── -->

          <!-- Tombol -->
          <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-pink px-4">
              <i class="bi bi-save me-1"></i><?= $editItem ? 'Update' : 'Simpan' ?>
            </button>
            <?php if ($editItem): ?>
            <a href="index.php?page=studies" class="btn btn-pink-outline px-3">Batal</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>

    <!-- ── Tabel ────────────────────────────────────────────────────────── -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="pink-title mb-0">Riwayat Pendidikan Hani</h5>
      <span class="badge rounded-pill" style="background:var(--pink-mid);font-size:.85rem;padding:.5rem 1rem;">
        Total: <?= count($studies) ?> data
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle rounded-3 overflow-hidden">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Institusi</th>
            <th>Level</th>
            <th>Keterangan</th>
            <th>Thn Lulus</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($studies)): ?>
          <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data studies.</td></tr>
          <?php else: ?>
          <?php foreach ($studies as $no => $s): ?>
          <tr>
            <td><strong style="color:var(--pink-mid)"><?= $no + 1 ?></strong></td>
            <td>
              <?php if (!empty($s['foto_sekolah'])): ?>
              <img src="assets/img/<?= htmlspecialchars($s['foto_sekolah']) ?>"
                   width="50" height="50"
                   style="object-fit:cover;border-radius:8px;border:2px solid var(--pink-light)"
                   alt="foto"
                   onerror="this.replaceWith(document.getElementById('placeholder-<?= $s['id'] ?>'))"/>
              <!-- Fallback jika gambar gagal load -->
              <div id="placeholder-<?= $s['id'] ?>" style="display:none;width:50px;height:50px;background:var(--pink-pale);border-radius:8px;align-items:center;justify-content:center;">
                <i class="bi bi-building" style="color:var(--pink-light)"></i>
              </div>
              <?php else: ?>
              <div style="width:50px;height:50px;background:var(--pink-pale);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-building" style="color:var(--pink-light)"></i>
              </div>
              <?php endif; ?>
            </td>
            <td><strong><?= htmlspecialchars($s['nama']) ?></strong></td>
            <td>
              <span class="badge rounded-pill" style="background:var(--pink-pale);color:var(--pink-deep)">
                <?= htmlspecialchars($s['level_nama'] ?? '-') ?>
              </span>
            </td>
            <td><?= htmlspecialchars($s['keterangan'] ?: '-') ?></td>
            <td><?= $s['tahun_lulus'] ?: '-' ?></td>
            <td>
              <a href="index.php?page=studies&edit_studies=<?= $s['id'] ?>" class="btn btn-sm btn-pink me-1">
                <i class="bi bi-pencil"></i>
              </a>
              <form method="POST" action="index.php?page=studies" style="display:inline"
                    onsubmit="return confirm('Yakin hapus data ini?')">
                <input type="hidden" name="action" value="delete"/>
                <input type="hidden" name="id" value="<?= $s['id'] ?>"/>
                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- ── Script Tab & Preview ─────────────────────────────────────────────────── -->
<script>
function switchTab(tab) {
    const uploadEl  = document.getElementById('tabUpload');
    const manualEl  = document.getElementById('tabManual');
    const btnUpload = document.getElementById('btnTabUpload');
    const btnManual = document.getElementById('btnTabManual');

    if (tab === 'upload') {
        uploadEl.style.display = 'block';
        manualEl.style.display = 'none';
        btnUpload.className = 'btn btn-sm btn-pink';
        btnManual.className = 'btn btn-sm btn-pink-outline';
        // Reset input manual
        document.querySelector('[name="nama_foto_manual"]').value = '';
    } else {
        uploadEl.style.display = 'none';
        manualEl.style.display = 'block';
        btnUpload.className = 'btn btn-sm btn-pink-outline';
        btnManual.className = 'btn btn-sm btn-pink';
        // Reset input file
        document.querySelector('[name="foto_sekolah"]').value = '';
        document.getElementById('fotoPreview').style.display = 'none';
    }
}

function previewFoto(input) {
    const preview    = document.getElementById('fotoPreview');
    const previewImg = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src      = e.target.result;
            preview.style.display = 'flex';
            preview.style.alignItems = 'center';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>