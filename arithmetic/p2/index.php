<?php

declare(strict_types=1);


class Solution
{

    /**
     * @param int $n
     * @return int
     */
    function pivotInteger(int $n)
    {
        if ($n === 1 ) {
            return 1;
        }
        if ($n === 2 ) {
            return -1;
        }
        $totalSum = $n * ($n + 1)/2;
        $possiblePivon = (int) sqrt($totalSum);

        if ($possiblePivon * $possiblePivon === $totalSum) {
            return $possiblePivon;
        }

        return -1;
    }
}

$cases = [
    [1, 1],
    [8, 6],
];

for ($i = 0; $i < count($cases); $i++) {
    $input = $cases[$i][0];
    $expectedOutput = $cases[$i][1];

    $solution = new Solution();
    $actualOutput = $solution->pivotInteger($input);

    if ($actualOutput === $expectedOutput) {
        echo "Test case " . ($i + 1) . " passed.\n";
    } else {
        echo "Test case " . ($i + 1) . " failed. Input: " . json_encode($input) . ", Expected: " . json_encode($expectedOutput) . ", Got: " . json_encode($actualOutput) . "\n";
    }
}
