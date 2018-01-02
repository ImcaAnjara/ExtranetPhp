<?php
	
  class Connexion{

      	function __construct(){

      	}
      	public function openConnexion($dns){

      		$con = odbc_connect($dns, "","");	
			if(!$con){
			  die("erreur de connexion");
			}
			
		return $con;
      	}
      	      	
      	public function closeConnexion($con){
      	  odbc_close($con);
      	}

      }

    class Common{

      	function __construct(){

      	}
      	public function fetch2DArray($res, $isFields = false){    
			$j = 0;
			$toReturn = array();
			//var_dump(odbc_fetch_array($res));die;
			while(odbc_fetch_array($res))
			{
				$ar = array();
				for ($j = 1; $j <= odbc_num_fields($res); $j++)
				{        
					 $field_name = odbc_field_name($res, $j);
					 if($isFields) {
						 $field = str_replace(" ", "_", utf8_encode($field_name)); //var_dump($field_name);die;
						 $ar[$field] = odbc_result($res, $field_name);
					 } else{
						$ar['cours_'.$j] = odbc_result($res, $field_name);
					}
				}
				$toReturn[] = array_map('utf8_encode', $ar);;
			}
			return $toReturn;    
		}


    }
?>