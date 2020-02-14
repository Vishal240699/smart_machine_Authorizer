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
    if(isset($_GET['stu_id'])&& isset($_GET['barcode']))
    {
        $sql="SELECT Tool_id FROM tool_barcode WHERE barcode='".$_GET['barcode']."'";
        $res=$link->query($sql);
        $row = $res->fetch_assoc();
        $sql1="INSERT INTO tool_log (Tool_id,stu_id,issdate) VALUES({$row['Tool_id']},{$_GET['stu_id']},NOW())";
        $res=$link->query($sql1);
        $resp['status']='success';
        $json_response = json_encode($resp);
        echo $json_response;
        exit();
    }
}
?>