<?php
namespace Models;

class Database
{
  /**
   * Database connection settings
   * @var string
   */
  private $db_host="localhost", $db_user="root", $db_password="", $db_name="currencies_db";
  
  /**
   * Database connection object
   * @var Database
   */
   private $db_connection;
   
  public function __construct(){
    $db_connection = mysqli_connect($this->db_host, $this->db_user, $this->db_password, $this->db_name);
    if(!$db_connection){
      echo "Problem while connecting to the database" . mysqli_connect_error();
      return 0;
    } else {
      $this->db_connection = $db_connection;
      return $db_connection;
    }
  }
  
  /**
   * Returns an array with all the currencies in currency table
   * @param Database $db
   * @return array
   */
  public function getAllCurrencies(){
    $all_currencies = [];
    $query = "SELECT currencies.id,currencies.symbol,currencies.name,currency_rates.to_id,currency_rates.rate FROM currencies LEFT JOIN currency_rates ON currencies.id = currency_rates.base_id";
    if($result = $this->db_connection->query($query)){
      
      while($row = $result->fetch_assoc()){
        
        // We want to create a "strange" multidimensional array, example:
        // [id]=>[symbol]
        //       [name]
        //       [rates][0]=>[to_id][rate]
        //       [rates][1]=>[to_id][rate]
        //        ...
        // That's why we use if-else with array_key_exists and array_push for the extra rates' cells
        if(array_key_exists($row['id'], $all_currencies)){
          array_push($all_currencies[$row['id']]['rates'],["to"=>$row['to_id'],"rate"=>$row['rate']]);
        } else {
          $all_currencies[$row['id']]= array(
            "symbol"=>$row['symbol'],
            "name"=>$row['name'],
            "rates"=>[["to"=>$row['to_id'],"rate"=>$row['rate']]]);
        }
      }
      
      $result->free();
    }
    return $all_currencies;
  }
  
  /**
   * Returns an array with currency details (symbol,name and rates)
   * @param int $id
   * @return array
   */
  public function getCurrencyById($id){
    $currency = [];
    $query = "SELECT currencies.symbol,currencies.name,currency_rates.to_id,currency_rates.rate FROM currencies LEFT JOIN currency_rates ON currencies.id = currency_rates.base_id WHERE currencies.id=$id";
    $i=0;
    if($result = $this->db_connection->query($query)){
      
      while($row = $result->fetch_assoc()){
        
        if($i!==0){
          $currency[0]['rates'][]=["to"=>$row['to_id'],"rate"=>$row['rate']];
        } else {
          $currency[]=["symbol"=>$row['symbol'],"name"=>$row['name'],"rates"=>[["to"=>$row['to_id'],"rate"=>$row['rate']]]];
        }
        $i++;
      }
      
      $result->free();
    }
    return $currency;
  }
  
  /**
   * Returns an array with currency details (id,symbol,name)
   * @param int $base_id
   * @return array
   */
  public function getTargetCurrenciesByBase($base_id){
    $currencies =[];
    $query = "SELECT * FROM currencies WHERE id!=$base_id";
    if($result = $this->db_connection->query($query)){
      while($row = $result->fetch_assoc()){
        $currencies[]=["id"=>$row['id'],"symbol"=>$row['symbol'],"name"=>$row['name']];
      }
      $result->free();
    }
    return $currencies;
  }
  
  /**
   * Returns an array with currency details (symbol,name and rates)
   * @param string $symbol
   * @return array
   */
   public function getCurrencyBySymbol($symbol){
     $currency = [];
     $query = 'SELECT * FROM currencies WHERE symbol='.$symbol;
     if($result = $this->db_connection->query($query)){
       while($row = $result->fetch_assoc()){
         
       }
     }
     
   }   
}