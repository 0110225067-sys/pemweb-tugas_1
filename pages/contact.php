<?php // pages/contact.php ?>
<div class="main-card card">
  <div class="section-header"><i class="bi bi-envelope-heart me-2"></i>Contact Me</div>
  <div class="card-body p-4">
    <h4 class="pink-title mb-1">Hubungi Saya 💌</h4>
    <p class="text-muted mb-4">Temukan saya di berbagai platform sosial media berikut!</p>

    <div class="row g-4">
      <?php
      $sosmed = [
        ['Instagram', 'bi-instagram',     '#fce4ec', '#e91e63', '@septihnyy',
         'https://instagram.com/septihnyy',
         'Follow for daily moments & stories'],

        ['WhatsApp',  'bi-whatsapp',      '#e8f5e9', '#25d366', '+62 8221245344',
         'https://wa.me/628221245344',
         'Chat langsung dengan saya'],

        ['TikTok',    'bi-tiktok',        '#090909', '#eaf1fa', '@hanoey',
         'https://tiktok.com/@haniseptiani321',
         'Fun videos & creative content'],

        ['Email',     'bi-envelope-fill', '#fff3e0', '#ff7043', 'hseptiani259@gmail.com',
         'mailto:hseptiani259@gmail.com',
         'Kirim pesan resmi ke saya'],

        ['Telegram',  'bi-telegram',      '#e3f2fd', '#0088cc', '@Hanoeyyyy',  // ✅ ganti username
         'https://t.me/Hanoeyyyy',                                              // ✅ ganti username
         'Chat via Telegram'],

        ['LinkedIn',  'bi-linkedin',      '#e8eaf6', '#0077b5', 'Hani Septiani',   // ✅ ganti nama linkedin
         'https://linkedin.com/in/Hani Septiani',                               // ✅ ganti username
         'Koneksi profesional saya'],
      ];
      foreach($sosmed as $s): ?>
      <div class="col-md-4">
        <div class="card sosmed-card h-100">
          <div class="card-body text-center p-4">
            <div class="sosmed-icon mb-3" style="background:<?= $s[2] ?>">
              <i class="bi <?= $s[1] ?>" style="color:<?= $s[3] ?>"></i>
            </div>
            <h6 class="fw-bold mb-1" style="color:var(--pink-deep)"><?= $s[0] ?></h6>
            <p class="text-muted small mb-3"><?= $s[6] ?></p>
            <a href="<?= $s[5] ?>" class="btn btn-pink btn-sm px-3" target="_blank">
              <i class="bi bi-box-arrow-up-right me-1"></i><?= $s[4] ?>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>