<?php
// data that will be received from html page
$name="'".$_POST['Name']."'";
$reg_no="'".$_POST['regno']."'";
$email="'".$_POST['email']."'";
$con_no="'".$_POST['conno']."'";
$pass=$_POST['Password'];
$reppass=$_POST['Repeatpassword'];
if(!($pass===$reppass))
{
    include('SignUp.html');
    exit();
}
$hash = password_hash($pass, PASSWORD_DEFAULT);
$hash="'".$hash."'";
$dept="'".$_POST['Department']."'";
//link to make the connection
$link = mysqli_connect("localhost", "root", "", "maindb");
// the if is to check connection errors
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{ 
  $sql="INSERT INTO adm_det (name,reg_no,email,con_no,pass,dept) VALUES ($name,$reg_no,$email,$con_no,$hash,$dept)";
    if ($link->query($sql) === TRUE)
    {
    header('Location:../index.html');
    }   
    else 
    {
    echo "Error: " . $sql . "<br>" . $link->error;
    }
}
?>