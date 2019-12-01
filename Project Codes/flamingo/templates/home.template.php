<?php $extend_layout = 'layout'; ?>

<?php function block_body($context) { ?>

<div id="hero_image">
  <div id="hero_text">
    <h3>All your<h3>
    <h1>Favourite Dresses</h1>
  </div>
</div>
<div class="composite_heading">
  <h1>Trending</h1>
  <p>Catch up with the trend</p>
</div>
<div>
  <div>
    <div id="items_carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#items_carousel" data-slide-to="0" class="active"></li>
        <li data-target="#items_carousel" data-slide-to="1"></li>
        <li data-target="#items_carousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" data-iterval="1000">
          <img src="static/images/image_1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="static/images/image_2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="static/images/image_3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#items_carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#items_carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>

<?php } //endblock_body ?>