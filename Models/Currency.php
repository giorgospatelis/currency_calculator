<?php
namespace Models;

class Currency
{
  /**
   * Symbol and Name of the currency
   * @var string
   */
  private $symbol,$name;
  
  /**
   * Currency id
   * @var int
   */
  private $id;
  
  /**
   * Rates of the currency
   * @var array
   */
  private $rates;
  
  /**
   * Database connection
   * @var object
   */
  private $db_connection;
  
  public function __construct(){
    $this->db_connection = new \Models\Database();
  }
  
  /**
   *
   * Sets up standard (defined by instructions) currencies.
   *
   * @param    string The three-letters symbol.
   *
   */
  public function setCurrency($symbol){
    self::setSymbol($symbol);
    self::setName($symbol);
    self::setRates($symbol);
  }
  
  /**
   *
   * Sets up currency by its id
   *
   * @param    int $id
   *
   */
  public function setCurrencyById($id){
    $currency_array = $this->db_connection->getCurrencyById($id);
    $this->id = $id;
    $this->symbol = $currency_array[0]['symbol'];
    $this->name = $currency_array[0]['name'];
    $this->rates = $currency_array[0]['rates'];
  }
  
  
  /**
   * Returns an array with all the available currencies
   * @var array
   */
  public function all(){
    return $this->db_connection->getAllCurrencies();
  }
  
  public function setCustomCurrency($symbol,$name,$rates=null){
    
  }
  
  /**
   * Properties Public Getters
  */
  
  /**
   * Returns an array with the rates of currency
   * @var array
   */
  public function getRates(){
    return $this->rates;
  }
  
  /**
   * Returns an array with the possible target currencies, i.e. currency id,symbol,name except the base currency
   * @var array
   */
  public function getTargetCurrencies(){
    return $this->db_connection->getTargetCurrenciesByBase($this->id);
  }
  
  /**
   * Properties Setters
  */
  private function setRates($rates){
    $this->rates = $rates;
  }
  
  private function setName($symbol){
    $this->name = $this->symbolNames[$symbol];
  }
  
  private function setSymbol($symbol){
    $this->symbol = $symbol;
  }
    
  private function setRateType($rt=0){
    $this->rateType = $rt;
  }
  
  /**
   * Private Model Functionality
  */
  
}