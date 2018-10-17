<?php 
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) {die('You shouldn\'t be here!');}

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$currency = new \Models\Currency();
$view = new \Views\CurrencyViews();
$controller = new \Controllers\IndexController();

if(isset($_POST['base_id']) && isset($_POST['value'])){
  $base_id = (int) strip_tags( trim( $_POST[ 'base_id' ] ) );
  $base_value = (double) strip_tags( trim( $_POST[ 'value' ] ) );
  
  $currency->setCurrencyById($base_id);
  $currency_rates = $currency->getRates();
  $response = [];
  foreach($currency_rates as $rate){
    $response[]=array((int)$rate['to'],(double)$rate['rate']*$base_value);
  }
  echo json_encode($response,JSON_FORCE_OBJECT);
}

// Request data: {"show":"refresh-converter","base_id":new_base}
if(isset($_POST['show']) && $_POST['show']=="refresh-converter"){
  $base_id = (int) strip_tags( trim( $_POST[ 'base_id' ] ) );
  $currency->setCurrencyById($base_id);
  $currencies = $currency->getTargetCurrencies();
  echo $view->convertToInputs($currencies);
}

if(isset($_POST['show']) && $_POST['show']=="currency-converter"){
  echo $controller->getIndex();
}
 ?>