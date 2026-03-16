<?php
/** @var \Kirby\Cms\Page $event */
$full = $full ?? false;
$categoryIcons = [
  'flight'      => '&#9992;&#65039;',
  'train'       => '&#128646;',
  'checkin'     => '&#127976;',
  'checkout'    => '&#128682;',
  'dining'      => '&#127860;',
  'activity'    => '&#127915;',
  'sightseeing' => '&#128248;',
  'shopping'    => '&#128717;',
  'freetime'    => '&#127774;',
  'other'       => '&#128204;',
];
$icon = $categoryIcons[$event->eventcategory()->value()] ?? '&#128204;';
?>

<a href="<?= $event->url() ?>" class="event-card <?= $full ? 'event-card--full' : '' ?>">
  <div class="event-card__time">
    <?php if ($event->eventtime()->isNotEmpty()): ?>
      <span class="event-card__clock"><?= $event->eventtime() ?></span>
    <?php else: ?>
      <span class="event-card__clock">TBD</span>
    <?php endif ?>
  </div>

  <div class="event-card__timeline">
    <div class="event-card__dot <?= $event->eventcategory()->value() ?>"></div>
    <div class="event-card__line"></div>
  </div>

  <div class="event-card__content">
    <div class="event-card__icon"><?= $icon ?></div>
    <div class="event-card__details">
      <h3 class="event-card__title"><?= $event->title() ?></h3>
      <?php if ($event->location()->isNotEmpty()): ?>
        <p class="event-card__location">&#128205; <?= $event->location() ?></p>
      <?php endif ?>
      <?php if ($full && $event->description()->isNotEmpty()): ?>
        <p class="event-card__desc"><?= $event->description()->excerpt(120) ?></p>
      <?php endif ?>
      <?php if ($full && $event->cost()->isNotEmpty()): ?>
        <p class="event-card__cost"><?= $event->cost() ?> <?= $event->currency() ?></p>
      <?php endif ?>
    </div>
    <span class="event-card__arrow">&rsaquo;</span>
  </div>
</a>
