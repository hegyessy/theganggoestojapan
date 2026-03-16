<?php
/** @var \Kirby\Cms\Page $location */
$full = $full ?? false;
$categoryIcons = [
  'restaurant' => '&#127860;',
  'cafe'       => '&#9749;',
  'bar'        => '&#127866;',
  'shrine'     => '&#9961;',
  'park'       => '&#127795;',
  'museum'     => '&#127963;',
  'shopping'   => '&#128717;',
  'hotel'      => '&#127976;',
  'station'    => '&#128646;',
  'viewpoint'  => '&#127748;',
  'entertainment' => '&#127902;',
  'other'      => '&#128204;',
];
$icon = $categoryIcons[$location->category()->value()] ?? '&#128204;';
?>

<a href="<?= $location->url() ?>"
   class="location-card <?= $full ? 'location-card--full' : '' ?>"
   data-category="<?= $location->category()->value() ?>"
   data-lat="<?= $location->lat() ?>"
   data-lng="<?= $location->lng() ?>">

  <div class="location-card__icon">
    <?= $icon ?>
  </div>

  <div class="location-card__info">
    <h3 class="location-card__title"><?= $location->title() ?></h3>

    <div class="location-card__meta">
      <span class="location-card__category"><?= ucfirst($location->category()->value()) ?></span>
      <?php if ($location->addedby()->isNotEmpty()): ?>
        <span class="location-card__by">by <?= $location->addedby() ?></span>
      <?php endif ?>
    </div>

    <?php if ($full && $location->description()->isNotEmpty()): ?>
      <p class="location-card__desc"><?= $location->description()->excerpt(100) ?></p>
    <?php endif ?>

    <?php if ($location->address()->isNotEmpty()): ?>
      <p class="location-card__address"><?= $location->address() ?></p>
    <?php endif ?>
  </div>

  <div class="location-card__right">
    <?php if ($location->rating()->isNotEmpty()): ?>
      <div class="location-card__rating">
        <span class="star filled">&#9733;</span>
        <span><?= $location->rating() ?></span>
      </div>
    <?php endif ?>
    <span class="location-card__arrow">&rsaquo;</span>
  </div>
</a>
