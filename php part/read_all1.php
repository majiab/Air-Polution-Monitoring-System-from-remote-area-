<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//Creating Array for JSON response
$response = array();
 
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");

 // Connecting to database 
$db = new DB_CONNECT();	
 
 // Fire SQL query to get all data from weather
$result = mysql_query("SELECT *FROM weathers") or die(mysql_error());
 
// Check for succesfull execution of query and no results found
if (mysql_num_rows($result) > 0) {
    
	// Storing the returned array in response
    $response["weathers"] = array();
 
	// While loop to store all the returned response in variable
    while ($row = mysql_fetch_array($result)) {
        // temperoary user array
        $weather = array();
        $weather["ID"] = $row["ID"];
        $weather["temp"] = $row["temp"];
        $weather["hum"] = $row["hum"];
        $weather["gasvalue"] = $row["gasvalue"];
        $weather["gas"] = $row["gas"];
        $weather["pump"] = $row["pump"];
        $weather["email"] = $row["email"];

		// Push all the items 
        array_push($response["weathers"], $weather);
    }
    // On success
    $response["success"] = 1;
 
    // Show JSON response
    echo json_encode($response);
}	
else 
{
    // If no data is found
	$response["success"] = 0;
    $response["message"] = "No data on weathers found";
 
    // Show JSON response
    echo json_encode($response);
}
?>