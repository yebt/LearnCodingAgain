<?php

declare(strict_types=1);


namespace LCPHP\testSuite;



class TestingBaseSuite
{

  static const greenColor = "\033[32m;";
  static const resetColor = "\033[0m;";
  static const redColor = "\033[31m;";
  static const boldColor = "\033[1m;";

  public static function runSuite(
    iterable $testSuite,
    callable $functionToUse,
  ) {

    foreach ($testSuite as $index => $testCase) {
      $args = $testCase[0];
      $result = $functionToUse(...$args);
      if ($result !== $testCase[1]) {
        echo self::redColor . "Test case";
        printf("[%4s]", $index);
        echo " failed:\n ";
        echo "Expected: " . var_export($testCase[1], true) . "\n";
        echo "Got: " . var_export($result, true) . "\n";
        echo self::resetColor . "=====================\n";
      } else {
        echo self::greenColor . "Test case";
        printf("[%4s]", $index);
        echo " passed.\n";
      }
    }
  }
}
