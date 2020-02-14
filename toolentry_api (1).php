<?php
header("Content-Type:application/json");
$link = mysqli_connect("localhost", "root", "", "maindb");
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{   //sql query
    if(isset($_GET['rfid']))
    {
        try
        {
        $sql="SELECT stu_id FROM stu_det WHERE rfid='".$_GET['rfid']."'";
        //result fetched for the query
        if(!$res=$link->query($sql))
        {
            throw 10;
        }
        //fetching a row of the result
        $row = $res->fetch_assoc();   
        }
        catch(exception $e)
        {
            $response['auth']='no';
            $json_response = json_encode($response);
            echo $json_response;
            exit();
        }
        $json_response = json_encode($row);
        echo $json_response;
        exit();
    }
     
}
?>