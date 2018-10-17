<?php 
/*
  @class IndexController
  @subpackage Controllers
  @description A class that controls the views and creation/use of currencies
  
*/
namespace Controllers;
use  Models\Currency;
use Views\CurrencyViews;
class IndexController
{
  /**
   * Currency object
   * @var Currency object
   */
  private $currency;
  /**
   * CurrencyView object
   * @var CurrencyViews object
   */
  private $view;
  
  
  public function __construct(){
    $this->currency = new \Models\Currency();
    $this->view = new \Views\CurrencyViews();
  }
  
  public function getIndex(){
    return print_r($this->view->indexConverter(1,$this->currency->all()),1);
  }
  
}