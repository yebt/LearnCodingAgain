<?php

declare(strict_types=1);

class Solution
{

    /**
     * @param int[] $arr
     * @return Boolean
     */
    function canMakeArithmeticProgression($arr)
    {

        $arrSize = count($arr);
        if ($arrSize < 2) {
            return false;
        }
        if ($arrSize === 2) {
            return true;
        }

        sort($arr);
        $firstEl = $arr[0];
        $lastElement = $arr[1];
        $lastDiff = $lastElement - $firstEl;

        for ($i = 2; $i  < $arrSize; $i++) {
            $elToEvaluate = $arr[$i];
            $diff = $elToEvaluate - $lastElement;

            if ($diff !== $lastDiff) {
                return false;
            }
            $lastElement = $elToEvaluate;
        }
        return true;
    }
}


// TESTS SOLUTIONS


$cases = [
    [[], false],
    [[1], false],
    [[1, 2], true],
    [[1, 2, 4], false],
    [[3, 5, 1], true],
    [[1, 2, 4], false],
    [[-68, -96, -12, -40, 16], true]
];

for ($i = 0; $i < count($cases); $i++) {
    $input = $cases[$i][0];
    $expectedOutput = $cases[$i][1];

    $solution = new Solution();
    $actualOutput = $solution->canMakeArithmeticProgression($input);

    if ($actualOutput === $expectedOutput) {
        echo "Test case " . ($i + 1) . " passed.\n";
    } else {
        echo "Test case " . ($i + 1) . " failed. Input: " . json_encode($input) . ", Expected: " . json_encode($expectedOutput) . ", Got: " . json_encode($actualOutput) . "\n";
    }
}
