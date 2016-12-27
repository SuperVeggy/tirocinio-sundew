<?php
  const BASICTAXRATE = 0.1;
  const IMPORTDUTYRATE = 0.05;

  function calculateBasicTax($price) {
    return $price * BASICTAXRATE;
  }

  function calculateImportDuty($price) {
    return $price * IMPORTDUTYRATE;
  }

  class SaleTax {
    function __construct($price, $basicTax, $importDuty) {
      $this->price = $price;

      if ($basicTax === TRUE) {
        $this->price += calculateBasicTax($price);
      }

      if ($importDuty === TRUE) {
        $this->price += calculateImportDuty($price);
      }

      $this->price = round($this->price, 2);
    }
  }

  $book = new SaleTax(12.49, FALSE, FALSE);
  $musicCD = new SaleTax(14.99, TRUE, FALSE);
  $chocolateBar = new SaleTax(0.85, FALSE, FALSE);

  function addPrices($prices) {
    $args = func_get_args();
    $sum = 0;
    foreach ($args as $arg) {
      $sum += $arg->price;
    }
    echo $sum;
  }

  addPrices($book, $musicCD, $chocolateBar);
?>
