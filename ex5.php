<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 5 - Status rules
// The rules array lives inside can_move() in helpers.php:
//   each status -> list of statuses it may move to.

// Test moves: [from, to, expected]
$moves = [
    ['Submitted',    'Under review', 'Allowed'],
    ['Submitted',    'Approved',     'Blocked'],
    ['Under review', 'Rejected',     'Allowed'],
    ['Approved',     'Submitted',    'Blocked'],
    ['Rejected',     'Submitted',    'Allowed'],
    ['Closed',       'Submitted',    'Blocked'],   // unknown status
];

foreach ($moves as $m) {
    $result = can_move($m[0], $m[1]) ? 'Allowed' : 'Blocked';
    $ok = ($result === $m[2]) ? 'PASS' : 'FAIL';
    echo "$m[0] → $m[1]: $result (expected $m[2]) - $ok\n";
}

// ----- Extension: who may make the move? -----
echo "\nRole tests:\n";

// Role tests: [role, from, to, expected]
$role_tests = [
    ['officer',   'Under review', 'Approved',  false],
    ['approver',  'Under review', 'Approved',  true],
    ['requester', 'Rejected',     'Submitted', true],
];

foreach ($role_tests as $t) {
    $result = can_move_as($t[0], $t[1], $t[2]);
    $ok = ($result === $t[3]) ? 'PASS' : 'FAIL';
    echo "can_move_as('$t[0]', '$t[1]', '$t[2]') = " . ($result ? 'true' : 'false') . " - $ok\n";
}

// Why is an array better than if/elseif?
// To change a rule we edit ONE line of data, not the logic. The code stays
// short, is easier to read, and a new status is just one more line.
