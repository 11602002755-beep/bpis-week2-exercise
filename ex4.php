<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 4 - Waiting-time alert
// wait_band() is written in helpers.php.

date_default_timezone_set('UTC');   // same timezone for every date calculation

$today = '2026-10-07';

// counters for the summary line
$overdue = 0;
$follow_up = 0;
$on_time = 0;

foreach ($requests as $r) {
    // only pending requests
    if (is_pending($r['status'])) {
        // given line: number of days between submitted date and today
        $days = intdiv(strtotime($today) - strtotime($r['submitted']), 86400);
        $band = wait_band($days);

        // tidy the names so ' sonam ' / 'dorji' print nicely
        $name = tidy($r['first']) . ' ' . tidy($r['last']);

        echo "#{$r['id']} $name — $days days — $band\n";

        // add to the right counter
        if ($band === 'Overdue') {
            $overdue++;
        } elseif ($band === 'Follow up') {
            $follow_up++;
        } elseif ($band === 'On time') {
            $on_time++;
        }
    }
}

echo "\n$overdue overdue · $follow_up follow up · $on_time on time\n";

// ----- Test the edges -----
echo "\nEdge tests:\n";
$edges = [-1, 0, 7, 8, 14, 15];
foreach ($edges as $d) {
    echo "wait_band($d) = " . wait_band($d) . "\n";
}
