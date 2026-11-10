<?php

declare(strict_types=1);

namespace LCPHP\TestSuite;

class TestingBaseSuite
{

  const resetColor = "\033[0m";
  const greenColor = "\033[32m";
  const redColor = "\033[31m";
  const grayColor = "\033[90m";
  const bgGreenColor = "\033[42m";
  const bgRedColor = "\033[41m";
  const boldColor = "\033[1m";

  public static function printError(){
    echo " " . self::redColor . "× ";
  }

  public static function printSuccess(){
    echo " " . self::greenColor . "✓ " . self::resetColor;
  }

  public static function runSuite(
    iterable $testSuite,
    callable $functionToUse,
  ) {

    foreach ($testSuite as $index => $testCase) {
      $args = $testCase[0];
      $result = $functionToUse(...$args);
      if ($result !== $testCase[1]) {
        self::printError();
        /* echo " " . self::redColor . "Test case"; */
        echo "[$index] Err " . self::resetColor . "\n";
        echo self::boldColor .  self::grayColor .  "Expected: ". self::resetColor . var_export($testCase[1], true) . "\n";
        echo self::boldColor .  self::grayColor .  "Got: ". self::resetColor . var_export($result, true) . "\n";
        echo self::grayColor . "---------------------------\n";
        echo self::resetColor;
      } else {
        self::printSuccess();
        echo "[$index] pass\n";
      }
    }
  }
}
