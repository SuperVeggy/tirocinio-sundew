<?php

  function printReceipt($shoppingList) {
    $itemsList = readInput($shoppingList);
    foreach ($itemsList[0] as $item) {
      echo $item->name . " " . $item->price . "<br>";
    }
    echo "Sales Taxes: " . $itemsList[2] . "<br>Total: " . $itemsList[1];
  }

  function readInput($inputFile) {
    $linesArray = file($inputFile);
    return splitArray($linesArray);
  }

  function splitArray($linesArray) {
    foreach ($linesArray as $line) {
      $wordsArray = explode(' ', $line);
      $itemPrice = array_pop($wordsArray);
      $applicatedTaxes = taxesValidation($wordsArray);
      $itemName = implode(' ', $wordsArray);
      $itemsList []= new SalesTax($itemPrice, $applicatedTaxes, $itemName);
    }
    return sumItems($itemsList);
  }

  function taxesValidation($wordsArray) {
    $importedGood = FALSE;
    $primaryGood = FALSE;
    switch ($wordsArray[1]) {
      case 'imported':
        $importedGood = TRUE;

        if ($wordsArray[2] != 'bottle') {
          $primaryGood = TRUE;
        }
        break;
      case 'book':
      case 'chocolate':
      case 'packet':
        $primaryGood = TRUE;
        break;
      case 'box':
        $importedGood = TRUE;
        $primaryGood = TRUE;
        break;
    }
    return array($importedGood, $primaryGood);
  }

  class SalesTax {
    function __construct($itemPrice, $applicatedTaxes, $itemName) {
      $this->price = $itemPrice;
      $this->name = $itemName;
      $this->taxes = 0;

      if ($applicatedTaxes[1] === FALSE) {
        $this->taxes += calculateBasic($itemPrice);
      }

      if ($applicatedTaxes[0] === TRUE) {
        $this->taxes += calculateDuty($itemPriceprice);
      }

      $this->price += $this->taxes;
    }
  }

  const IMPORTDUTY = 0.05;
  const BASICTAX = 0.1;

  function calculateBasic($price) {
    return round($price * BASICTAX, 2);
  }

  function calculateDuty($price) {
    return round($price * IMPORTDUTY, 2);
  }

  function sumItems($itemsList) {
    $grandTotal = 0;
    $salesTaxes = 0;
    foreach ($itemsList as $item) {
      $grandTotal += $item->price;
      $salesTaxes += $item->taxes;
    }
    return array($itemsList, $grandTotal, $salesTaxes);
  }

?>
