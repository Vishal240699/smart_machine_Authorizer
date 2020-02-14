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
        
        $sql="SELECT stu_id,name,reg_no FROM stu_det WHERE rfid='".$_GET['rfid']."'";
        //result fetched for the query
        $res=$link->query($sql);
        $row = $res->fetch_assoc();
        if($row)
        {
             //fetching a row of the result
             
            $json_response = json_encode($row);
            echo $json_response;
            exit();
        }
         
        else 
        {
            $response['stu_id']='0';
            $json_response = json_encode($response);
            echo $json_response;
            exit();
        }
        
    }
     
}
?>