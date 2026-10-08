# Week 2 Logic Exercises – Written Answers

## Exercise 1 – Predict the Output

| Snippet | Prediction  | Reason                                                                                                                                            |

| A       | `none \| 0` | `?:` considers `0` as false, so it returns `none`. However, `??` only works when the value is `null` or not set. Since `$x` is `0`, it stays `0`. |
| B       | `19`        | The loop adds 1, 2, 4, 5, and 7. It skips 3 and 6 because of `continue`. When it reaches 8, `break` stops the loop. So, 1 + 2 + 4 + 5 + 7 = 19.   |
| C       | `BaC`       | `b = 2` and `c = 3` are both greater than 1, so they are changed to uppercase. `a = 1` does not meet the condition, so it stays lowercase.        |
| D       | `4ro`       | `trim()` removes the spaces around `Paro`, leaving 4 characters. The last two characters of `Paro` are `ro`.                                      |

After running the code, all four answers matched my predictions. The two things I had to be careful about were remembering that `??` does not work the same way as `?:`, and that `continue` skips an iteration while `break` stops the loop completely.

---

## Exercise 2 – Think About It

If the names are not cleaned up first, the program will treat `' paro '` and `'Paro'` as two different places. Because of this, each one would have only one pending request, and the program would show all of them as tied.

That would be incorrect because they are actually the same place, Paro, and should have two pending requests.

---

## Exercise 3 – My Decision (ID 12345)

`sprintf('%04d', 12345)` gives `12345` because the number already has five digits.

I would accept this result. I don't think we should cut it down to four digits because that could change the reference number and might cause two different requests to have the same reference. I also added this decision as a comment in `helpers.php`.

---

## Exercise 4 – Edge Tests

| `wait_band(...)` | -1         | 0       | 7       | 8         | 14        | 15      |
| ---------------- | ---------- | ------- | ------- | --------- | --------- | ------- |
| My result        | Check date | On time | On time | Follow up | Follow up | Overdue |

The values I would be most careful with are **7 and 14**, because the conditions need to include those numbers correctly. For example, using `< 7` instead of `<= 7` would give the wrong result for 7.

I also had to make sure that `-1` was checked first. Otherwise, it could incorrectly be treated as being on time.

---

## Exercise 5 – Why an Array Is Better Than `if/elseif`

I think using an array is better because the rules are easier to manage. If I need to change a rule, I can just change the data in one place instead of changing a lot of `if/elseif` statements.

It also keeps the code shorter and easier to understand. If I want to add another status later, I can simply add another line to the array.

---

## Exercise 6 – Bug Log

| # | Symptom                                                                                      | Cause                                                                                  | Fix                                  |
| - | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | ------------------------------------ |
| 1 | I got the warning `Undefined array key "Status"` 7 times.                                    | The actual key was `'status'` with a lowercase `s`. PHP array keys are case-sensitive. | Change `['Status']` to `['status']`. |
| 2 | The first record was not checked, so the count was wrong.                                    | The loop started at `$i = 1`, but arrays start at index 0.                             | Start the loop with `$i = 0`.        |
| 3 | Every record was counted as Submitted.                                                       | I used `=` instead of comparing the values. `=` assigns a value.                       | Use `===` for the comparison.        |
| 4 | The total never increased.                                                                   | `$total + 1;` calculates the new value but does not store it.                          | Use `$total = $total + 1;`.          |
| 5 | I got a TypeError because the function was supposed to return an `int` but returned nothing. | The function was missing a `return` statement.                                         | Add `return $total;`.                |

The hardest bugs for me were **3 and 4** because PHP did not show an error. The program still ran, but the result was wrong. I had to look carefully at the code to find the problem.

Bug 5 became noticeable after fixing the earlier problems because the missing `return` caused an error at the end.

---

## Exercise 7 – Think About It

I don't think every duplicate request should automatically be considered an error. The same person could send another request because they made a mistake or had to resubmit something.

However, requests 1 and 4, and requests 3 and 7, have different names but the same CID. This could be a typing mistake, or it could be something more serious.

Because of that, I think Karma should check the original documents and contact the people involved before making a decision. The requests should not be automatically deleted or rejected just because they look like duplicates.

---

## AI-Use Reflection

I used AI to help me understand and work through the exercises. I accepted some of the explanations and answers, but I also checked the code and compared the results with the expected output.

I read through the files and made sure I understood the main reasons behind the answers before completing the worksheet.
