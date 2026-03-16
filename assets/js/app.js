/* ==========================================
   The Gang Goes to Japan - Map & Interactions
   ========================================== */

// Category icon mapping for markers
const CATEGORY_ICONS = {
  restaurant:    '🍜',
  cafe:          '☕',
  bar:           '🍺',
  shrine:        '⛩',
  park:          '🌳',
  museum:        '🏛',
  shopping:      '🛍',
  hotel:         '🏨',
  station:       '🚆',
  viewpoint:     '🌄',
  entertainment: '🎮',
  flight:        '✈️',
  train:         '🚆',
  checkin:       '🏨',
  checkout:      '🚪',
  dining:        '🍜',
  activity:      '🎫',
  sightseeing:   '📸',
  freetime:      '🌞',
  other:         '📌',
};

/**
 * Create a custom circle marker with category color
 */
function createMarker(lat, lng, category) {
  const el = document.createElement('div');
  el.className = 'custom-marker ' + (category || 'other');

  return L.marker([lat, lng], {
    icon: L.divIcon({
      className: '',
      html: el.outerHTML,
      iconSize: [28, 28],
      iconAnchor: [14, 14],
      popupAnchor: [0, -16],
    }),
  });
}

/**
 * Build popup HTML for a location
 */
function locationPopup(loc) {
  return '<span class="popup-category">' + (loc.category || '') + '</span>' +
    '<strong>' + loc.title + '</strong>' +
    (loc.address ? '<div>' + loc.address + '</div>' : '') +
    (loc.addedBy ? '<div style="color:#8e8e93;font-size:0.75rem;">by ' + loc.addedBy + '</div>' : '') +
    '<a href="' + loc.url + '" class="popup-link">View details &rarr;</a>';
}

/**
 * Build popup HTML for an itinerary event
 */
function eventPopup(ev) {
  return '<span class="popup-category">' + (ev.category || '') + '</span>' +
    '<strong>' + ev.title + '</strong>' +
    (ev.location ? '<div>📍 ' + ev.location + '</div>' : '') +
    (ev.date ? '<div style="color:#8e8e93;font-size:0.75rem;">' + ev.date + (ev.time ? ' · ' + ev.time : '') + '</div>' : '') +
    '<a href="' + ev.url + '" class="popup-link">View details &rarr;</a>';
}

/**
 * Create a standard tile layer
 */
function tileLayer() {
  return L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19,
  });
}

/* ==========================================
   Home Map - shows all locations + itinerary
   ========================================== */
function initHomeMap() {
  const container = document.getElementById('home-map');
  if (!container) return;

  const map = L.map('home-map', { zoomControl: false }).setView([35.6762, 139.6503], 12);
  tileLayer().addTo(map);

  L.control.zoom({ position: 'topright' }).addTo(map);

  const bounds = [];

  // Fetch locations
  fetch('/api/locations')
    .then(r => r.json())
    .then(locations => {
      locations.forEach(loc => {
        if (!loc.lat || !loc.lng) return;
        const marker = createMarker(loc.lat, loc.lng, loc.category);
        marker.bindPopup(locationPopup(loc));
        marker.addTo(map);
        bounds.push([loc.lat, loc.lng]);
      });

      // Fetch itinerary
      return fetch('/api/itinerary');
    })
    .then(r => r.json())
    .then(events => {
      events.forEach(ev => {
        if (!ev.lat || !ev.lng) return;
        const marker = createMarker(ev.lat, ev.lng, ev.category || 'itinerary');
        marker.bindPopup(eventPopup(ev));
        marker.addTo(map);
        bounds.push([ev.lat, ev.lng]);
      });

      if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [30, 30], maxZoom: 14 });
      }
    })
    .catch(err => console.error('Map data error:', err));
}

/* ==========================================
   Locations Map - all locations with filtering
   ========================================== */
function initLocationsMap() {
  const container = document.getElementById('locations-map');
  if (!container) return;

  const map = L.map('locations-map', { zoomControl: false }).setView([35.6762, 139.6503], 12);
  tileLayer().addTo(map);
  L.control.zoom({ position: 'topright' }).addTo(map);

  window._locationsMap = map;
  window._locationMarkers = [];

  fetch('/api/locations')
    .then(r => r.json())
    .then(locations => {
      const bounds = [];

      locations.forEach(loc => {
        if (!loc.lat || !loc.lng) return;
        const marker = createMarker(loc.lat, loc.lng, loc.category);
        marker.bindPopup(locationPopup(loc));
        marker.addTo(map);
        marker._category = loc.category;
        window._locationMarkers.push(marker);
        bounds.push([loc.lat, loc.lng]);
      });

      if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [30, 30], maxZoom: 14 });
      }
    })
    .catch(err => console.error('Locations error:', err));
}

/* ==========================================
   Itinerary Map - all events with route line
   ========================================== */
function initItineraryMap() {
  const container = document.getElementById('itinerary-map');
  if (!container) return;

  const map = L.map('itinerary-map', { zoomControl: false }).setView([35.6762, 139.6503], 12);
  tileLayer().addTo(map);
  L.control.zoom({ position: 'topright' }).addTo(map);

  fetch('/api/itinerary')
    .then(r => r.json())
    .then(events => {
      const bounds = [];
      const routePoints = [];

      events.forEach(ev => {
        if (!ev.lat || !ev.lng) return;
        const marker = createMarker(ev.lat, ev.lng, ev.category || 'itinerary');
        marker.bindPopup(eventPopup(ev));
        marker.addTo(map);
        bounds.push([ev.lat, ev.lng]);
        routePoints.push([ev.lat, ev.lng]);
      });

      // Draw a dashed line connecting events in order
      if (routePoints.length > 1) {
        L.polyline(routePoints, {
          color: '#0095f6',
          weight: 2,
          opacity: 0.5,
          dashArray: '8, 8',
        }).addTo(map);
      }

      if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [30, 30], maxZoom: 14 });
      }
    })
    .catch(err => console.error('Itinerary error:', err));
}

/* ==========================================
   Detail Map - single location pin
   ========================================== */
function initDetailMap() {
  const container = document.getElementById('detail-map');
  if (!container) return;

  const lat = parseFloat(container.dataset.lat);
  const lng = parseFloat(container.dataset.lng);
  const title = container.dataset.title || '';

  if (isNaN(lat) || isNaN(lng)) return;

  const map = L.map('detail-map', { zoomControl: false }).setView([lat, lng], 16);
  tileLayer().addTo(map);
  L.control.zoom({ position: 'topright' }).addTo(map);

  const marker = createMarker(lat, lng, 'other');
  marker.bindPopup('<strong>' + title + '</strong>').openPopup();
  marker.addTo(map);
}

/* ==========================================
   Filter chips for locations page
   ========================================== */
function initFilters() {
  const chips = document.querySelectorAll('.filter-chip');
  const cards = document.querySelectorAll('.location-card[data-category]');

  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      // Update active chip
      chips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');

      const filter = chip.dataset.filter;

      // Filter cards
      cards.forEach(card => {
        if (filter === 'all' || card.dataset.category === filter) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });

      // Filter map markers
      if (window._locationMarkers && window._locationsMap) {
        const bounds = [];
        window._locationMarkers.forEach(marker => {
          if (filter === 'all' || marker._category === filter) {
            marker.addTo(window._locationsMap);
            bounds.push(marker.getLatLng());
          } else {
            window._locationsMap.removeLayer(marker);
          }
        });

        if (bounds.length > 0) {
          window._locationsMap.fitBounds(bounds, { padding: [30, 30], maxZoom: 14 });
        }
      }
    });
  });
}
