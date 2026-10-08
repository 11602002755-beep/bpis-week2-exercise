<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 7 - Duplicate and invalid CIDs
// No array_count_values().

// Step 1: group request ids by CID.
// Example: ['10101001234' => [1, 4]]
$groups = [];

foreach ($requests as $r) {
    $cid = $r['cid'];

    // first time we see this CID, make an empty list for it
    if (!isset($groups[$cid])) {
        $groups[$cid] = [];
    }
    // add this request id to the CID's list
    $groups[$cid][] = $r['id'];
}

// Step 2: print only the CIDs used by more than one request
foreach ($groups as $cid => $ids) {
    if (count($ids) > 1) {
        // implode joins the list with ", " -> "1, 4"
        echo "Duplicate $cid: requests " . implode(', ', $ids) . "\n";
    }
}

// Step 3: list every invalid CID (is_valid_cid() is in helpers.php)
foreach ($requests as $r) {
    if (!is_valid_cid($r['cid'])) {
        echo "Invalid CID in request {$r['id']}: {$r['cid']}\n";
    }
}

// Think about: a duplicate is NOT always an error. The same person may
// have sent two requests (a resubmission). But requests 1 and 4 have
// DIFFERENT names on the same CID, so one may be a typing mistake or a
// fraud attempt. Karma should check the original documents and contact
// the people, not delete or reject automatically.
