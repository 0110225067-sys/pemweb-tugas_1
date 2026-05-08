<?php // pages/about.php ?>
<div class="main-card card">
  <div class="section-header"><i class="bi bi-person-heart me-2"></i>About Me</div>
  <div class="card-body p-4">
    <h4 class="pink-title mb-3">✨ Kenalan Yuk!</h4>

    <div class="accordion" id="aboutAccordion">

      <!-- Hobi -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header">
          <button class="accordion-button fw-bold rounded-3" type="button"
                  data-bs-toggle="collapse" data-bs-target="#hobbyCollapse">
            🎨 Hobi Saya
          </button>
        </h2>
        <div id="hobbyCollapse" class="accordion-collapse collapse show" data-bs-parent="#aboutAccordion">
          <div class="accordion-body bg-white">
            <ul class="list-unstyled mb-0">
              <li class="mb-2"><i class="bi bi-music-note-beamed me-2" style="color:var(--pink-mid)"></i>Mendengarkan musik </li>
              <li class="mb-2"><i class="bi bi-camera me-2" style="color:var(--pink-mid)"></i>Fotografi dan editing foto</li>
              <li class="mb-0"><i class="bi bi-airplane me-2" style="color:var(--pink-mid)"></i>Traveling &amp; eksplorasi tempat baru</li
              <li class="mb-0"><i class="bi bi-laptop me-2" style="color:var(--pink-mid)"></i>Coding &amp; membuat web yang cantik</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Favorite Menu -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed fw-bold rounded-3" type="button"
                  data-bs-toggle="collapse" data-bs-target="#foodCollapse">
            🍜 Favorite Menu
          </button>
        </h2>
        <div id="foodCollapse" class="accordion-collapse collapse" data-bs-parent="#aboutAccordion">
          <div class="accordion-body bg-white">
            <div class="row g-3">
              <?php
              $foods = [
                ['🍜','Mie Ayam'],['🍦','Es Krim Strawberry'],
                ['🧋','Boba Brown Sugar'],['🍰','Strawberry Cake'],
                ['🍡','Mochi'],['🥤','Matcha'],
              ];
              foreach($foods as $f): ?>
              <div class="col-6 col-md-4">
                <div class="p-3 rounded-3 text-center h-100" style="background:var(--pink-pale)">
                  <div style="font-size:2rem"><?= $f[0] ?></div>
                  <div class="fw-bold mt-1" style="color:var(--pink-deep);font-size:.9rem"><?= $f[1] ?></div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Pengalaman Organisasi -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed fw-bold rounded-3" type="button"
                  data-bs-toggle="collapse" data-bs-target="#orgCollapse">
            🏆 Pengalaman Organisasi
          </button>
        </h2>
        <div id="orgCollapse" class="accordion-collapse collapse" data-bs-parent="#aboutAccordion">
          <div class="accordion-body bg-white">
            <?php
            $orgs = [

              ['Anggota HIMA TI – Bidang Bendahara','2026 – sekarag','Mengelola Keuangan HIMA TI','var(--pink-mid)'],
              ['OSIS – Seksi Seni & Budaya','2019 – 2021','Koordinator acara seni sekolah','var(--pink-light)'],
            ];
            foreach($orgs as $o): ?>
            <div class="d-flex gap-3 mb-3">
              <div style="width:14px;height:14px;min-width:14px;background:<?=$o[3]?>;border-radius:50%;margin-top:5px;box-shadow:0 0 0 3px var(--pink-pale)"></div>
              <div>
                <strong style="color:var(--pink-deep)"><?= $o[0] ?></strong><br/>
                <small class="text-muted"><?= $o[1] ?></small><br/>
                <span style="font-size:.9rem"><?= $o[2] ?></span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Skills -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed fw-bold rounded-3" type="button"
                  data-bs-toggle="collapse" data-bs-target="#skillCollapse">
            💡 Skills &amp; Kemampuan
          </button>
        </h2>
        <div id="skillCollapse" class="accordion-collapse collapse" data-bs-parent="#aboutAccordion">
          <div class="accordion-body bg-white">
            <?php
            $skills = [
              ['HTML / CSS','80'],['Bootstrap','85'],['PHP','75'],
              ['JavaScript','70'],['MySQL','72'],['Desain UI','75'],
            ];
            foreach($skills as $s): ?>
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <span class="fw-bold" style="color:var(--pink-deep)"><?= $s[0] ?></span>
                <span style="color:var(--pink-mid)"><?= $s[1] ?>%</span>
              </div>
              <div class="progress" style="height:10px;border-radius:8px;background:var(--pink-pale)">
                <div class="progress-bar" style="width:<?=$s[1]?>%;background:linear-gradient(90deg,var(--pink-mid),var(--pink-light));border-radius:8px;"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
