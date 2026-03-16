<?php snippet('header') ?>

<div class="page-screen">
  <a href="/itinerary" class="back-link">&larr; All Events</a>

  <div class="event-detail">
    <div class="detail-header">
      <div class="detail-category-badge <?= $page->eventcategory()->value() ?>">
        <?= ucfirst($page->eventcategory()->value()) ?>
      </div>
      <h1><?= $page->title() ?></h1>

      <div class="event-meta">
        <?php if ($page->eventdate()->isNotEmpty()): ?>
          <span class="meta-item">&#128197; <?= date('l, M j, Y', strtotime($page->eventdate()->value())) ?></span>
        <?php endif ?>
        <?php if ($page->eventtime()->isNotEmpty()): ?>
          <span class="meta-item">&#128336; <?= $page->eventtime() ?></span>
        <?php endif ?>
      </div>
    </div>

    <?php if ($page->lat()->isNotEmpty() && $page->lng()->isNotEmpty()): ?>
      <div class="card">
        <div id="detail-map" class="map-container map-small"
          data-lat="<?= $page->lat() ?>"
          data-lng="<?= $page->lng() ?>"
          data-title="<?= $page->title() ?>">
        </div>
      </div>
    <?php endif ?>

    <?php if ($page->location()->isNotEmpty()): ?>
      <div class="card info-row">
        <span class="info-icon">&#128205;</span>
        <span><strong><?= $page->location() ?></strong></span>
      </div>
    <?php endif ?>

    <?php if ($page->address()->isNotEmpty()): ?>
      <div class="card info-row">
        <span class="info-icon">&#128204;</span>
        <span><?= $page->address() ?></span>
      </div>
    <?php endif ?>

    <?php if ($page->description()->isNotEmpty()): ?>
      <div class="card">
        <h3>Details</h3>
        <?= $page->description()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->reservationinfo()->isNotEmpty()): ?>
      <div class="card reservation-card">
        <h3>&#127915; Reservation Info</h3>
        <?= $page->reservationinfo()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->cost()->isNotEmpty()): ?>
      <div class="card info-row">
        <span class="info-icon">&#128176;</span>
        <span><?= $page->cost() ?> <?= $page->currency() ?></span>
      </div>
    <?php endif ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  initDetailMap();
});
</script>

<?php snippet('footer') ?>
