<?php
header("Content-Type:application/json");
$link = mysqli_connect("localhost", "root", "", "maindb");
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{   if(isset($_GET['rfid'])&&isset($_GET['machine_name']))
    {
    $sql="SELECT machine_id FROM machine_det WHERE machine_name='{$_GET['machine_name']}'";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    $machine_id=$row['machine_id'];
    $sql="SELECT stu_id FROM stu_det WHERE rfid='{$_GET['rfid']}'";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    $stu_id=$row['stu_id'];
    $sql="SELECT auth_stat FROM machine_auth WHERE machine_id='$machine_id' AND stu_id='$stu_id'";
    $res=$link->query($sql);
    $row = $res->fetch_assoc();
    $auth_stat=$row['auth_stat'];
    if($auth_stat==='yes')
    {
        $response['code']=200; 
        $json_response = json_encode($response);
        $sql="INSERT INTO machine_log (machine_id,stu_id,starttime) VALUES ($machine_id,$stu_id,NOW())";
        $res=$link->query($sql);
        echo $json_response;
        exit();
    }
    else
    {
        $response['code']=404;
        $json_response = json_encode($response);
        echo $json_response;
        exit();
    }
    }
}
?>