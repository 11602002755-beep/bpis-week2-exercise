<?php

declare(strict_types=1);

// ---------------------------------------------------------------
// helpers.php - small functions shared by all the exercises
// ---------------------------------------------------------------

// Tidy a word: remove extra spaces, make it lower-case,
// then make the first letter a capital.
// ' sonam ' -> 'Sonam'     'paro' -> 'Paro'
function tidy(string $text): string
{
    return ucfirst(strtolower(trim($text)));
}

// Is this request still pending? (Submitted or Under review)
function is_pending(string $status): bool
{
    return $status === 'Submitted' || $status === 'Under review';
}

// Exercise 3 - build a reference like PAR-2026-0002
function make_reference(int $id, string $dzongkhag, string $submitted): string
{
    // Part 1: first 3 letters of the Dzongkhag, in capitals
    $part1 = strtoupper(substr(trim($dzongkhag), 0, 3));

    // Part 2: the year = the first 4 characters of '2026-09-20'
    $part2 = substr($submitted, 0, 4);

    // Part 3: the id as 4 digits (2 becomes 0002)
    // DECISION for id 12345: sprintf does NOT cut a long number, so we get
    // 12345 (5 digits). I accept this because cutting it to 4 digits would
    // give a WRONG reference and could make two requests look the same.
    $part3 = sprintf('%04d', $id);

    return $part1 . '-' . $part2 . '-' . $part3;
}

// Exercise 4 - turn "days waiting" into a band
function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';   // date is in the future - something is wrong
    } elseif ($days <= 7) {
        return 'On time';      // 0 to 7
    } elseif ($days <= 14) {
        return 'Follow up';    // 8 to 14
    } else {
        return 'Overdue';      // 15 or more
    }
}

// Exercise 5 - can a request move from one status to another?
function can_move(string $from, string $to): bool
{
    // The rules: each status lists the statuses it may move to.
    $rules = [
        'Submitted'    => ['Under review'],
        'Under review' => ['Approved', 'Rejected'],
        'Rejected'     => ['Submitted'],
        'Approved'     => [],   // final - nothing allowed
    ];

    // ?? [] means: if $from is not in the rules (unknown status),
    // use an empty list instead. So no warning, and the answer is false.
    $allowed = $rules[$from] ?? [];

    return in_array($to, $allowed, true);
}

// Exercise 5 extension - can this ROLE make the move?
function can_move_as(string $role, string $from, string $to): bool
{
    // Which statuses each role is allowed to move a request TO.
    $role_rules = [
        'officer'   => ['Under review'],
        'approver'  => ['Approved', 'Rejected'],
        'requester' => ['Submitted'],
    ];

    // Unknown role -> empty list -> not allowed
    $role_allowed = $role_rules[$role] ?? [];

    // Two checks must BOTH pass:
    // 1) the role may move to $to   2) the workflow itself allows it
    return in_array($to, $role_allowed, true) && can_move($from, $to);
}

// Exercise 7 - a valid CID is exactly 11 characters, all digits
function is_valid_cid(string $cid): bool
{
    return strlen($cid) === 11 && ctype_digit($cid);
}
