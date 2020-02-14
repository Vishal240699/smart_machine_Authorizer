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
    if(isset($_GET['barcode']))
    {
        $sql="SELECT Tool_name FROM tool_barcode WHERE barcode={$_GET['barcode']}";
        $res=$link->query($sql);
        $row = $res->fetch_assoc();
        if($row)
        {
            
            $json_response = json_encode($row);
            echo $json_response;
            exit();
        }
         
        else 
        {
            $response['Tool_name']='null';
            $json_response = json_encode($response);
            echo $json_response;
            exit();
        }
    
    }
}
?>