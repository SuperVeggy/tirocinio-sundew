<?php
  const BASICTAXRATE = 0.1;
  const IMPORTDUTYRATE = 0.05;

  function calculateBasicTax($price) {
    return round($price * BASICTAXRATE, 2);
  }

  function calculateImportDuty($price) {
    return round($price * IMPORTDUTYRATE, 2);
  }

  class SalesTax {
    function __construct($price, $goodsItem, $importedItem, $name) {
      $this->price = $price;
      $this->name = $name;
      $this->salesTax = 0;

      if ($goodsItem === FALSE) {
        $this->salesTax += calculateBasicTax($price);
      }

      if ($importedItem === TRUE) {
        $this->salesTax += calculateImportDuty($price);
      }

      $this->price += $this->salesTax;
    }
  }

  function addPrices($items) {
    $sum = 0;
    $salesTaxes = 0;
    foreach ($items as $item) {
      $sum += $item->price;
      $salesTaxes += $item->salesTax;
    }

    showPrices($items, $sum, $salesTaxes);
  }

  function readInput($inputFile) {
    $linesArray = file($inputFile);
    $items = [];

    foreach ($linesArray as $line) {
      $wordsArray = explode(' ', $line);
      $itemPrice = array_pop($wordsArray);
      $importedItem = FALSE;
      $goodsItem = FALSE;

      switch ($wordsArray[1]) {
        case 'imported':
          $importedItem = TRUE;

          if ($wordsArray[2] != 'bottle') {
            $goodsItem = TRUE;
          }
          break;

        case 'book':
        case 'chocolate':
        case 'packet':
          $goodsItem = TRUE;
          break;

        case 'box':
          $importedItem = TRUE;
          $goodsItem = TRUE;
          break;
      }

      $itemName = implode(' ', $wordsArray);
      $items []= new SalesTax($itemPrice, $goodsItem, $importedItem, $itemName);
    }

    addPrices($items);
  }

  function showPrices($items, $sum, $salesTaxes) {
    foreach ($items as $item) {
      echo $item->name . " " . $item->price . "<br>";
    }

    echo "Sales Taxes: " . $salesTaxes . "<br>Total: " . $sum;
  }

  readInput('salesTax.txt');
?>
