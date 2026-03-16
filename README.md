# The Gang Goes to Japan

A FourSquare-style group travel planning app built with [Kirby CMS](https://getkirby.com). Share locations of interest, display them on an interactive map, and manage your travel itinerary together.

## Features

- **Shared Location Lists** — Add restaurants, temples, bars, viewpoints, and more with ratings, descriptions, and GPS coordinates
- **Interactive Maps** — All locations displayed on Leaflet/OpenStreetMap maps with category-colored markers and filtering
- **Travel Itinerary** — Day-by-day event timeline with reservation info, costs, and a route map connecting events
- **FourSquare-inspired UI** — iOS-style tab bar, card-based layout, category badges, and star ratings
- **Kirby Panel** — Full admin panel for managing content through a friendly UI

## Requirements

- PHP 8.1+
- Composer

## Quick Start

```bash
# Install dependencies
composer install

# Start the PHP dev server
php -S localhost:8000

# Visit in your browser
open http://localhost:8000
```

## Kirby Panel

Access the admin panel at `/panel` to manage locations and itinerary events through a visual interface. On first visit you'll create an admin account.

## Project Structure

```
├── assets/
│   ├── css/app.css          # FourSquare-style CSS
│   └── js/app.js            # Leaflet map + filtering JS
├── content/
│   ├── home/                # Homepage content
│   ├── 1_locations/         # Location entries (flat-file)
│   └── 2_itinerary/         # Itinerary events (flat-file)
├── site/
│   ├── blueprints/          # Kirby panel field definitions
│   ├── config/config.php    # Routes + API endpoints
│   ├── snippets/            # Reusable template partials
│   └── templates/           # Page templates
├── index.php                # Entry point
└── .htaccess                # Apache rewrite rules
```

## API Endpoints

- `GET /api/locations` — JSON array of all published locations
- `GET /api/itinerary` — JSON array of all confirmed itinerary events

## Content Management

Content is stored as flat files in the `content/` directory. Each location/event is a folder with a `.txt` file containing field data in Kirby's format. You can edit content directly in the files or through the Kirby Panel.

## Tech Stack

- **Kirby CMS 5** — Flat-file PHP CMS
- **Leaflet.js** — Interactive maps via OpenStreetMap
- **Vanilla CSS/JS** — No build step required
