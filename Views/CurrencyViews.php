<?php 
/*
  @class CurrencyViews
  @subpackage Views
  @description A class that renders view components for currencies
  
*/
namespace Views;

class CurrencyViews
{
  
  public function __construct(){
    //Instatiate CurrencyView Object!
  }
  
  /**
   * Returns an HTML string that shows the index Currency Converter
   * @param int $base_id default is 1 (EUR)
   * @param array $currencies_array all available currencies
   * @return string
   */
  public function indexConverter($base_id=1,$currencies_array){
    $html = '<h2 class="base_title">Convert</h2><div class="col-12"><input type="text" class="base_currency" name="base_currency" id="'.$base_id.'">';
    $html .= '<select class="select_base">';
    foreach($currencies_array as $key=>$value){
      if($key==$base_id){
        $html .= '<option value="'.$key.'" selected>'.$value['symbol'].'</option>';
      } else {
        $html .= '<option value="'.$key.'">'.$value['symbol'].'</option>';
      }
      
    }
    $html .= "</select></div>";
    $html .= '<h2>To:</h2><div class="row" id="convert_to_currencies">';
    foreach($currencies_array as $key=>$currency){
      if($key!=$base_id){
        $html .= '<div class="col-4"><span class="lbl_'.$key.'">'.$currency['name'].'</span> <input type="text" name="to_currency" class="to_'.$key.'" readonly></div>';
      }
      
    }
    $html .='</div><div class="debug"></div>';
    return $html;
  }
  
  /**
   * Returns an HTML string that shows the target currencies inputs (it's fired upon change of base currency)
   * @param array $target_currencies all available currencies
   * @return string
   */
  public function convertToInputs($target_currencies){
    $html = '';
    foreach($target_currencies as $currency){
      $html .='<div class="col-4"><span class="lbl_'.$currency['id'].'">'.$currency['name'].'</span> <input type="text" name="to_currency" class="to_'.$currency['id'].'" readonly></div>';
    }
    
    return $html;
  }
}