<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
// Check if we got the field from the user
if (isset($_GET['temp']) && isset($_GET['hum']) && isset($_GET['gasvalue']) && isset($_GET['gas']) && isset($_GET['pump']) && isset($_GET['email'])  )
{
    //  
    
 //isset($_GET['temp']) && isset($_GET['hum']) && isset($_GET['gasvalue'])&&
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];
    $gasvalue=$_GET['gasvalue'];
    $gas=$_GET['gas'];
    $pump=$_GET['pump'];
    $email=$_GET['email'];
 
    // Include data base connect class
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."/db_connect.php");

 
    // Connecting to database 
    $db = new DB_CONNECT();
 
    // Fire SQL query to insert data in weather
    //temp,hum,gasvalue,
    //'$temp','$hum','$gasvalue',
   
   /*
    if($gasstatus==1 && $pump==1 && $email==1){
      
      //$result = mysql_query("INSERT INTO weathers(gasstatus) VALUES('It is Noramal Condition')");  
      $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Normal Conditions','Pump is Off','Email is not Active')");
        
    }
      else if($gasstatus==2 && $pump==2 && $email==2){
      
      //$result = mysql_query("INSERT INTO weathers(gasstatus) VALUES('It is Noramal Condition')");  
      $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Modarate Condition or Good','Pump is Off','Email is not Active')");
        
    }*/
    //$result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Modarate Condition or Good','Pump is Off','Email is not Active')");
   // $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Modarate Condition or Good','Pump is Off','Email is not Active')");
   // $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gasstatus) VALUES('$temp','$hum','$gasvalue','$gasstatus')");
   
   if($gas==1){
   
   $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Normal Condition','Pump is off','Email is Inactive')");
   }
   
   else if($gas==2){
   
   $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Modarate Condition','Pump is off','Email is Inactive')");
   }
   
   
    else if($gas==3){
   
   $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Unhealthy Condition for Sensetive Group','Pump is off','Email has been sent')");
   }
 
     else if($gas==4){
   
   $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Unhealthy Condition','Pump is off','Email has been sent')");
   }
    
     else if($gas==5){
   
   $result = mysql_query("INSERT INTO weathers(temp,hum,gasvalue,gas,pump,email) VALUES('$temp','$hum','$gasvalue','Hazardous Condition ','Pump is off','Email has been sent')");
   }
 
    // Check for succesfull execution of query
    if ($result) {
        // successfully inserted 
        $response["success"] = 1;
        $response["message"] = "Weather successfully created.";
 
        // Show JSON response
        echo json_encode($response);
    } else {
        // Failed to insert data in database
        $response["success"] = 0;
        $response["message"] = "Something has been wrong";
 
        // Show JSON response
        echo json_encode($response);
    }
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>