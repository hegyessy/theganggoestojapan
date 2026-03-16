<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page->title() ?> | <?= $site->title() ?></title>

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />

  <!-- Google Fonts - retro iOS feel -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- App CSS -->
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
  <nav class="tab-bar">
    <a href="/" class="tab-item <?= $page->isHomePage() ? 'active' : '' ?>">
      <span class="tab-icon">&#127968;</span>
      <span class="tab-label">Home</span>
    </a>
    <a href="/locations" class="tab-item <?= $page->slug() === 'locations' || $page->parent()?->slug() === 'locations' ? 'active' : '' ?>">
      <span class="tab-icon">&#128205;</span>
      <span class="tab-label">Places</span>
    </a>
    <a href="/itinerary" class="tab-item <?= $page->slug() === 'itinerary' || $page->parent()?->slug() === 'itinerary' ? 'active' : '' ?>">
      <span class="tab-icon">&#128197;</span>
      <span class="tab-label">Itinerary</span>
    </a>
  </nav>

  <main class="app-content">
