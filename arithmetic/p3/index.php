<?php

declare(strict_types=1);


class Solution {

    /**
     * @param Int $x
     * @return Boolean
     */
    function isPalindrome($x) {
        if ($x < 0) {
            return false;
        }
        $str = (string)$x;
        $reversedStr = strrev($str);
        return $str === $reversedStr;
    }
}
$cases = [
    [121, true],
    [-121, false],
    [-10, false],
];

for ($i = 0; $i < count($cases); $i++) {
    $input = $cases[$i][0];
    $expectedOutput = $cases[$i][1];

    $solution = new Solution();
    $actualOutput = $solution->isPalindrome($input);

    if ($actualOutput === $expectedOutput) {
        echo "Test case " . ($i + 1) . " passed.\n";
    } else {
        echo "Test case " . ($i + 1) . " failed. Input: " . json_encode($input) . ", Expected: " . json_encode($expectedOutput) . ", Got: " . json_encode($actualOutput) . "\n";
    }
}

