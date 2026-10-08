<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 2 - Busiest Dzongkhag (pending = Submitted or Under review)
// No max(), arsort() or array_count_values() - only loops and if.

// Loop 1: count pending requests for each Dzongkhag
$counts = [];   // example: ['Paro' => 2, 'Thimphu' => 1]

foreach ($requests as $r) {
    if (is_pending($r['status'])) {
        // tidy() makes ' paro ' and 'Paro' the same word
        $place = tidy($r['dzongkhag']);

        // first time we see this place, start at 0
        if (!isset($counts[$place])) {
            $counts[$place] = 0;
        }
        $counts[$place] = $counts[$place] + 1;
    }
}

// Loop 2: find the highest count
$highest = 0;
foreach ($counts as $place => $count) {
    if ($count > $highest) {
        $highest = $count;
    }
}

// Loop 3: print every Dzongkhag that has the highest count (handles ties)
foreach ($counts as $place => $count) {
    if ($count === $highest) {
        echo "Busiest: $place ($count pending)\n";
    }
}

// Think about: if we forget to tidy the names, ' paro ' and 'Paro' are
// counted as two different places. Then every place has only 1 pending
// request, so the program would print ALL of them as tied. Wrong answer!
