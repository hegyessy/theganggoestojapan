<?php

return [
    'debug' => true,
    'panel' => [
        'install' => true,
    ],
    'routes' => [
        [
            'pattern' => 'api/locations',
            'action'  => function () {
                $locations = [];
                $locationsPage = site()->find('locations');

                if ($locationsPage) {
                    foreach ($locationsPage->children()->listed() as $location) {
                        $locations[] = [
                            'title'       => $location->title()->value(),
                            'lat'         => (float) $location->lat()->value(),
                            'lng'         => (float) $location->lng()->value(),
                            'category'    => $location->category()->value(),
                            'description' => $location->description()->value(),
                            'address'     => $location->address()->value(),
                            'addedBy'     => $location->addedby()->value(),
                            'rating'      => (int) $location->rating()->value(),
                            'url'         => $location->url(),
                        ];
                    }
                }

                return Kirby\Http\Response::json($locations);
            }
        ],
        [
            'pattern' => 'api/itinerary',
            'action'  => function () {
                $events = [];
                $itineraryPage = site()->find('itinerary');

                if ($itineraryPage) {
                    foreach ($itineraryPage->children()->listed() as $event) {
                        $events[] = [
                            'title'       => $event->title()->value(),
                            'date'        => $event->eventdate()->value(),
                            'time'        => $event->eventtime()->value(),
                            'location'    => $event->location()->value(),
                            'lat'         => (float) $event->lat()->value(),
                            'lng'         => (float) $event->lng()->value(),
                            'description' => $event->description()->value(),
                            'category'    => $event->eventcategory()->value(),
                            'url'         => $event->url(),
                        ];
                    }
                }

                return Kirby\Http\Response::json($events);
            }
        ],
    ],
];
