<?php

  function add($string) {
    $numbers = splitString($string);
    return sumNumbers($numbers);
  }

  function splitString($string) {
    if (areNewDelimiters($string)) {
      $endstr = strpos($string, "\n");
		  $delimiter = substr($string, 2, $endstr - 2);
		  return preg_split("/$delimiter/", $string);
    } else {
    return preg_split("/[,\n]/", $string);
    }
  }

  function areNewDelimiters($string) {
    $newDelimitersMatch = "/^[\/\/]{2}.*\n/";
    return preg_match($newDelimitersMatch, $string);
  }

  function sumNumbers($numbers) {
      $sum = 0;

      foreach ($numbers as $number) {
  		  if ($number < 0) {
  			  throw new Exception("negatives not allowed: $number");
  		  }

  		  if ($number <= 1000) {
  			  $sum += $number;
  		  }
  	  }

    return $sum;
  }

  function test($expected, $actual) {
    if ($expected != $actual) {
      echo "Mi aspettavo $expected, ho avuto $actual <br/>";
    } else {
      echo ".";
    }
  }

  test(0, add(""));
  test(3, add("3"));
  test(7, add("3,4"));
  test(12, add("3,4,5"));
  test(7, add("3\n4"));
  test(12, add("//;\n3;4;5"));
  test(12, add("//;;;\n3;;;4;;;5"));
  test(7, add("//;;;\n3;;;4;;;1001"));
  test(7, add("//;;;\n-3;;;4;;;1001"));

?>
