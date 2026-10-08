<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 3 - Reference numbers
// make_reference() is written in helpers.php.

// Print a reference for all 8 records
foreach ($requests as $r) {
    echo make_reference($r['id'], $r['dzongkhag'], $r['submitted']) . "\n";
}

echo "\n--- Tests ---\n";

// Each test: [id, dzongkhag, date, expected result]
$tests = [
    [2, ' paro ',  '2026-09-20', 'PAR-2026-0002'],
    [6, 'Bumthang', '2026-10-03', 'BUM-2026-0006'],
    [1, 'Thimphu',  '2026-09-14', 'THI-2026-0001'],
];

foreach ($tests as $t) {
    $result = make_reference($t[0], $t[1], $t[2]);
    $ok = ($result === $t[3]) ? 'PASS' : 'FAIL';
    echo "$result (expected $t[3]) - $ok\n";
}

// id 12345 gives 5 digits: THI-2026-12345. Decision explained in helpers.php.
echo make_reference(12345, 'Thimphu', '2026-09-14') . "\n";
