<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 6 - Find the bugs (FIXED version)
// The original had 5 bugs. Each fix is marked with "BUG n" below.

function count_pending(array $requests): int
{
    $total = 0;

    // BUG 1: was "$i = 1" - that skipped the first record (index 0).
    for ($i = 0; $i < count($requests); $i++) {

        // BUG 2: was ['Status'] - key names are case-sensitive, the key is 'status'.
        $status = $requests[$i]['status'];

        // BUG 3: was "$status = 'Submitted'" - one = ASSIGNS a value.
        //        We need === to COMPARE.
        if ($status === 'Submitted' || $status === 'Under review') {

            // BUG 4: was "$total + 1;" - that adds but throws the answer away.
            //        We must save it back into $total.
            $total = $total + 1;
        }
    }

    // BUG 5: the function had no return, but it promises to return an int.
    return $total;
}

echo count_pending($requests); // prints 5
echo "\n";
