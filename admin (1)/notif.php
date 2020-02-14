<?php
session_start();
$email="'".$_SESSION['email']."'";
$link = mysqli_connect("localhost", "root", "", "maindb");
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{   //sql query
    if(isset($_POST['Subject']) && isset($_POST['message']))
    {   $sub="'".$_POST['Subject']."'";
        $mes="'".$_POST['message']."'";
        echo $sub;
        echo $mes;
        $sql="INSERT INTO notice (user,subject,Description,Date) VALUES($email,$sub,$mes,DATE(NOW()));";
        $res=$link->query($sql);
        header("Location:./admin.php");
    }
}
?>