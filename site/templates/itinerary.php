<?php snippet('header') ?>

<div class="page-screen">
  <div class="page-header">
    <h1>&#128197; Itinerary</h1>
    <p class="page-subtitle"><?= $page->children()->listed()->count() ?> events planned</p>
  </div>

  <!-- Map with itinerary pins -->
  <div class="card">
    <div id="itinerary-map" class="map-container map-small"></div>
  </div>

  <!-- Group events by date -->
  <?php
    $events = $page->children()->listed()->sortBy('eventdate', 'asc', 'eventtime', 'asc');
    $groupedEvents = [];
    foreach ($events as $event) {
      $date = $event->eventdate()->value() ?: 'TBD';
      $groupedEvents[$date][] = $event;
    }
  ?>

  <div class="itinerary-timeline">
    <?php foreach ($groupedEvents as $date => $dayEvents): ?>
      <div class="day-group">
        <div class="day-header">
          <div class="day-date">
            <?php if ($date !== 'TBD'): ?>
              <?= date('l', strtotime($date)) ?>
              <span class="day-number"><?= date('M j', strtotime($date)) ?></span>
            <?php else: ?>
              TBD
            <?php endif ?>
          </div>
          <span class="day-count"><?= count($dayEvents) ?> event<?= count($dayEvents) > 1 ? 's' : '' ?></span>
        </div>

        <?php foreach ($dayEvents as $event): ?>
          <?php snippet('event-card', ['event' => $event, 'full' => true]) ?>
        <?php endforeach ?>
      </div>
    <?php endforeach ?>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  initItineraryMap();
});
</script>

<?php snippet('footer') ?>
