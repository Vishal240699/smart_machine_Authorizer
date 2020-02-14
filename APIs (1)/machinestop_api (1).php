<?php
header("Content-Type:application/json");
$link = mysqli_connect("localhost", "root", "", "maindb");
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{   if(isset($_GET['rfid'])&&isset($_GET['machine_name'])&&isset($_GET['powerconsumed']))
{
    $sql="SELECT machine_id FROM machine_det WHERE machine_name='{$_GET['machine_name']}'";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    $machine_id=$row['machine_id'];
    $sql="SELECT stu_id FROM stu_det WHERE rfid='{$_GET['rfid']}'";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    $stu_id=$row['stu_id'];
    $sql="SELECT starttime FROM machine_log WHERE machine_id=$machine_id AND stu_id=$stu_id  ORDER BY starttime  DESC LIMIT 1";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    echo $starttime=$row['starttime'];
    echo "\n",$machine_id,"\n",$stu_id;
    $sql="UPDATE machine_log SET endtime=NOW(),power_consumed={$_GET['powerconsumed']} WHERE machine_id=$machine_id AND stu_id=$stu_id AND starttime='$starttime' ";
    $res=$link->query($sql);
     
}
}
?>