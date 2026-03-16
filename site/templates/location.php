<?php snippet('header') ?>

<div class="page-screen">
  <a href="/locations" class="back-link">&larr; All Places</a>

  <div class="location-detail">
    <div class="detail-header">
      <div class="detail-category-badge <?= $page->category()->value() ?>">
        <?= ucfirst($page->category()->value()) ?>
      </div>
      <h1><?= $page->title() ?></h1>

      <?php if ($page->rating()->isNotEmpty()): ?>
        <div class="rating">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star <?= $i <= $page->rating()->toInt() ? 'filled' : '' ?>">&#9733;</span>
          <?php endfor ?>
        </div>
      <?php endif ?>

      <?php if ($page->addedby()->isNotEmpty()): ?>
        <div class="added-by">Added by <strong><?= $page->addedby() ?></strong></div>
      <?php endif ?>
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

    <?php if ($page->description()->isNotEmpty()): ?>
      <div class="card">
        <h3>About</h3>
        <?= $page->description()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->address()->isNotEmpty()): ?>
      <div class="card info-row">
        <span class="info-icon">&#128204;</span>
        <span><?= $page->address() ?></span>
      </div>
    <?php endif ?>

    <?php if ($page->website()->isNotEmpty()): ?>
      <div class="card info-row">
        <span class="info-icon">&#127760;</span>
        <a href="<?= $page->website() ?>" target="_blank" rel="noopener"><?= $page->website() ?></a>
      </div>
    <?php endif ?>

    <?php if ($page->mapnotes()->isNotEmpty()): ?>
      <div class="card">
        <h3>&#128652; Getting There</h3>
        <?= $page->mapnotes()->kt() ?>
      </div>
    <?php endif ?>

    <?php if ($page->tags()->isNotEmpty()): ?>
      <div class="tags">
        <?php foreach ($page->tags()->split(',') as $tag): ?>
          <span class="tag"><?= trim($tag) ?></span>
        <?php endforeach ?>
      </div>
    <?php endif ?>

    <?php if ($page->images()->count() > 0): ?>
      <div class="section">
        <h3>&#128248; Photos</h3>
        <div class="photo-grid">
          <?php foreach ($page->images() as $image): ?>
            <div class="photo-item">
              <img src="<?= $image->url() ?>" alt="<?= $image->caption()->or($page->title()) ?>" loading="lazy">
              <?php if ($image->caption()->isNotEmpty()): ?>
                <p class="photo-caption"><?= $image->caption() ?></p>
              <?php endif ?>
            </div>
          <?php endforeach ?>
        </div>
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
