<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

// Exercise 1 - Predict the output
// Predictions were made BEFORE running. Run this file to check them.

// ----- Snippet A -----
// Prediction: none | 0
// Reason: ?: treats 0 as "false", so it picks 'none'.
//         ?? only replaces null (or missing), and $x is 0, so it keeps 0.
$x = 0;
$label = $x ?: 'none';
$size = $x ?? 'none';
echo "A: $label | $size\n";

// ----- Snippet B -----
// Prediction: 19
// Reason: i=1,2 add (3). i=3 skipped. i=4,5 add (12). i=6 skipped.
//         i=7 adds (19). i=8 is bigger than 7, so break.  1+2+4+5+7 = 19
$total = 0;
for ($i = 1; $i <= 10; $i++) {
    if ($i % 3 === 0) {
        continue;
    }
    if ($i > 7) {
        break;
    }
    $total += $i;
}
echo "B: $total\n";

// ----- Snippet C -----
// Prediction: BaC
// Reason: b=2 and c=3 are bigger than 1, so they become capitals (B, C).
//         a=1 is not bigger than 1, so it stays small (a).
$m = ['b' => 2, 'a' => 1, 'c' => 3];
$out = '';
foreach ($m as $k => $v) {
    $up = $v > 1;
    $out .= $up ? strtoupper($k) : $k;
}
echo "C: $out\n";

// ----- Snippet D -----
// Prediction: 4ro
// Reason: trim removes the spaces, so 'Paro' has length 4.
//         substr('Paro', -2) takes the last 2 letters = 'ro'.
$n = strlen(trim('  Paro  '));
echo "D: " . $n . substr('Paro', -2) . "\n";
