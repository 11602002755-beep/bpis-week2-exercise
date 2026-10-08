# Week 2 Logic Exercises - Written Answers

(Write your own name, Student ID and date in the worksheet. Use your own words
for the reflection - see the note at the bottom.)

## Exercise 1 - Predict the output

| Snippet | Prediction | Reason |
|---|---|---|
| A | `none \| 0` | `?:` treats 0 as false, so it picks 'none'. `??` only replaces null/missing, and $x is 0, so it stays 0. |
| B | `19` | Adds 1, 2, 4, 5, 7. Skips 3 and 6 (continue). At 8 it breaks. 1+2+4+5+7 = 19. |
| C | `BaC` | b=2 and c=3 are > 1 so they become capitals. a=1 is not > 1 so it stays small. |
| D | `4ro` | trim removes spaces so length is 4. substr('Paro', -2) = 'ro'. |

After running: all four matched. (The usual mistakes: thinking `??` works like `?:` in A, and
forgetting that `continue` skips and `break` stops in B.)

## Exercise 2 - Think about
If the names are not tidied, ' paro ' and 'Paro' are counted as two different places. Every place
then has only 1 pending request, so the program prints ALL of them as tied. That is wrong,
because Paro really has 2.

## Exercise 3 - My decision (id 12345)
`sprintf('%04d', 12345)` gives `12345` (5 digits). I accept this. Cutting it to 4 digits would
make a wrong reference and could make two requests look the same. (Also written as a comment in helpers.php.)

## Exercise 4 - Edge tests

| wait_band(...) | -1 | 0 | 7 | 8 | 14 | 15 |
|---|---|---|---|---|---|---|
| My result | Check date | On time | On time | Follow up | Follow up | Overdue |

Edges people usually get wrong first: 7 and 14 (using `< 7` instead of `<= 7`), and -1 (forgetting to
check "below 0" FIRST, so it wrongly says On time).

## Exercise 5 - Why an array is better than if/elseif
To change a rule you edit one line of data, not the logic. The code stays short and easy to read,
and adding a new status is just one more line in the array.

## Exercise 6 - Bug log

| # | Symptom (what I saw) | Cause | Fix |
|---|---|---|---|
| 1 | Warnings "Undefined array key "Status"" (7 times, line 8) | Key is `'status'` (lower-case). PHP keys are case-sensitive. | Change `['Status']` to `['status']` |
| 2 | No error, but the first record was never checked (wrong count) | Loop started at `$i = 1`; arrays start at 0 | Start with `$i = 0` |
| 3 | Every record counted as Submitted (silent wrong answer) | `=` assigns a value; it does not compare | Use `===` |
| 4 | Total never goes up (silent wrong answer) | `$total + 1;` calculates but does not save | `$total = $total + 1;` |
| 5 | Fatal error: TypeError, function returned nothing but promises `int` | Missing `return` | Add `return $total;` |

Hardest bugs: 3 and 4, because PHP shows no error at all - the code runs, it just gives a wrong
answer. You only find them by reading the code carefully. Bug 5 only showed up after bug 1-4 were
understood, because the fatal error comes at the very end.

## Exercise 7 - Think about
A duplicate is not always an error. The same person may have sent two requests (for example a
resubmission). But requests 1 and 4 (and 3 and 7) have DIFFERENT names on the same CID, so one may be
a typing mistake or even fraud. Karma should check the original documents and contact the people,
not delete or reject automatically.

---
Note on the AI-use declaration: the worksheet says to record AI use. Write honestly in the weekly
reflection what you asked for (e.g. "asked AI to solve the exercises"), what you accepted, and how you
checked it (e.g. "ran every file and compared to the expected output"). Read through each file and make
sure you can explain every line before you submit.
