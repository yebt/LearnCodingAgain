<?php

declare(strict_types=1);

namespace LCPHP\Problems;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * 3360. Stone Removal Game
 * Easy
 *
 * Alice and Bob are playing a game where they take turns removing stones from a pile, with Alice going first.
 *
 *     Alice starts by removing exactly 10 stones on her first turn.
 *     For each subsequent turn, each player removes exactly 1 fewer stone than the previous opponent.
 *
 * The player who cannot make a move loses the game.
 *
 * Given a positive integer n, return true if Alice wins the game and false otherwise.
 *
 *
 *
 * Example 1:
 *
 * Input: n = 12
 *
 * Output: true
 *
 * Explanation:
 *
 *     Alice removes 10 stones on her first turn, leaving 2 stones for Bob.
 *     Bob cannot remove 9 stones, so Alice wins.
 *
 * Example 2:
 *
 * Input: n = 1
 *
 * Output: false
 *
 * Explanation:
 *
 *     Alice cannot remove 10 stones, so Alice loses.
 *
 *
 *
 * Constraints:
 *
 *     1 <= n <= 50
 *
 * */

class D3360
{
    /**
     * @param Int $n
     * @return boolean
     */
    function canAliceWin($n)
    {
        if ($n < 10 || $n == 55) {
            return false;
        }
        if ($n == 10) {
            return true;
        }
        $rst = 55 - $n;
        $pos = (-1 + sqrt(1 + (8 * $rst))) / 2;
        $isInt = !((int) $pos != $pos);
        $isEven = ((int) $pos % 2) == 0;

        return $isEven xor $isInt;

        /* if ($isEven) { */
        /*     // last play was Bob */
        /*     return !$isint; */
        /* } else { */
        /**/
        /*     // last plat was Alice */
        /*     return $isint; */
        /* } */
        /* return match (true) { */
        /*     $n < 10 => false, */
        /*     $n == 10 => true, */
        /*     default => (($n - 10) % 2) == 0, */
        /* }; */
    }
}

class_alias(D3360::class, 'Solution');
use LCPHP\TestSuite\TestingBaseSuite;
use Solution;

$testSuite = [
    [2, false],
    [10, true],
    [11, true],
    [12, true],
    [27, true],
    [1, false],
];

TestingBaseSuite::runSuite(
    /* [$testSuite[count($testSuite) - 2]], */
    /* [$testSuite[4]], */
    $testSuite,
    [new Solution(), 'canAliceWin'],
);
