<?php snippet('header') ?>

<div class="home-screen">
  <div class="hero">
    <div class="hero-badge">&#9992;&#65039;</div>
    <h1 class="hero-title"><?= $page->headline()->or('The Gang Goes to Japan') ?></h1>
    <p class="hero-subtitle"><?= $page->subheadline()->or('Our shared travel guide & itinerary') ?></p>
    <?php if ($site->tripdates()->isNotEmpty()): ?>
      <div class="hero-dates"><?= $site->tripdates() ?></div>
    <?php endif ?>
  </div>

  <?php if ($page->intro()->isNotEmpty()): ?>
    <div class="card intro-card">
      <?= $page->intro()->kt() ?>
    </div>
  <?php endif ?>

  <!-- Quick Stats -->
  <?php
    $locationsPage = $site->find('locations');
    $itineraryPage = $site->find('itinerary');
    $locationCount = $locationsPage ? $locationsPage->children()->listed()->count() : 0;
    $eventCount = $itineraryPage ? $itineraryPage->children()->listed()->count() : 0;
  ?>
  <div class="stats-grid">
    <a href="/locations" class="stat-card">
      <span class="stat-icon">&#128205;</span>
      <span class="stat-number"><?= $locationCount ?></span>
      <span class="stat-label">Places Saved</span>
    </a>
    <a href="/itinerary" class="stat-card">
      <span class="stat-icon">&#128197;</span>
      <span class="stat-number"><?= $eventCount ?></span>
      <span class="stat-label">Events Planned</span>
    </a>
  </div>

  <!-- Mini Map Preview -->
  <div class="card">
    <h2 class="card-title">&#127758; Map Overview</h2>
    <div id="home-map" class="map-container map-small"></div>
  </div>

  <!-- Recent Locations -->
  <?php if ($locationsPage && $locationsPage->children()->listed()->count() > 0): ?>
    <div class="section">
      <div class="section-header">
        <h2>&#128293; Recent Spots</h2>
        <a href="/locations" class="see-all">See All &rarr;</a>
      </div>
      <div class="location-scroll">
        <?php foreach ($locationsPage->children()->listed()->limit(5) as $loc): ?>
          <?php snippet('location-card', ['location' => $loc]) ?>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif ?>

  <!-- Upcoming Events -->
  <?php if ($itineraryPage && $itineraryPage->children()->listed()->count() > 0): ?>
    <div class="section">
      <div class="section-header">
        <h2>&#128336; Coming Up</h2>
        <a href="/itinerary" class="see-all">See All &rarr;</a>
      </div>
      <?php foreach ($itineraryPage->children()->listed()->sortBy('eventdate', 'asc')->limit(3) as $event): ?>
        <?php snippet('event-card', ['event' => $event]) ?>
      <?php endforeach ?>
    </div>
  <?php endif ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  initHomeMap();
});
</script>

<?php snippet('footer') ?>
