<?php snippet('header') ?>

<div class="page-screen">
  <div class="page-header">
    <h1>&#128205; Places</h1>
    <p class="page-subtitle"><?= $page->children()->listed()->count() ?> spots saved</p>
  </div>

  <!-- Filter Bar -->
  <div class="filter-bar">
    <button class="filter-chip active" data-filter="all">All</button>
    <?php
      $categories = [];
      foreach ($page->children()->listed() as $loc) {
        $cat = $loc->category()->value();
        if ($cat && !in_array($cat, $categories)) {
          $categories[] = $cat;
        }
      }
      sort($categories);
      foreach ($categories as $cat):
    ?>
      <button class="filter-chip" data-filter="<?= $cat ?>"><?= ucfirst($cat) ?></button>
    <?php endforeach ?>
  </div>

  <!-- Map -->
  <div class="card">
    <div id="locations-map" class="map-container"></div>
  </div>

  <!-- Location List -->
  <div class="locations-list" id="locations-list">
    <?php foreach ($page->children()->listed()->sortBy('title', 'asc') as $location): ?>
      <?php snippet('location-card', ['location' => $location, 'full' => true]) ?>
    <?php endforeach ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  initLocationsMap();
  initFilters();
});
</script>

<?php snippet('footer') ?>
