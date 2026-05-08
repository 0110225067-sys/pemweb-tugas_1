<!-- header.php - 12 grid carousel -->
<style>
#mainCarousel .carousel-caption {
  z-index: 2;
}
#mainCarousel .carousel-item img {
  height: 320px;
  width: 100%;
  object-fit: cover;
  object-position: center;
}
</style>

<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
  </div>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="assets/IMG/foto_3.jpg" class="d-block" alt="Slide 1"/>
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 fw-bold" style="font-family:'Playfair Display',serif;color:#7d1a4a;text-shadow:0 2px 8px rgba(255,255,255,.8)">  Selamat Datang </h5>
        <p style="color:#7d1a4a">Personal Homepage – Hani🌸</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/IMG/foto_2.jpg" class="d-block" alt="Slide 2"/>
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 fw-bold" style="font-family:'Playfair Display',serif;color:#7d1a4a;text-shadow:0 2px 8px rgba(255,255,255,.8)"></h5>
        <p></p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/IMG/foto_1.jpg" class="d-block" alt="Slide 3"/>
      <div class="carousel-caption d-none d-md-block">
        <h5 class="display-6 fw-bold" style="font-family:'Playfair Display',serif;color:#7d1a4a;text-shadow:0 2px 8px rgba(255,255,255,.8)"> </h5>
        <p></p>
      </div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>