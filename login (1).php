<?php
function xss_cleaner($input_str) 
{
    $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}
$reg_no=xss_cleaner($_POST["uname"]);
$pass=xss_cleaner($_POST["pass"]);
//link to make the connection
$link = mysqli_connect("localhost", "root", "", "maindb");
//checks for connection error
if ($link -> connect_errno) 
{
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
else
{   if(isset($_POST['user']))
    {
    //sql query
    $sql="SELECT pass FROM stu_det WHERE reg_no='".$reg_no."'";
    //result fetched for the query
    $res=$link->query($sql);
    //fetching a row of the result
    $row = $res->fetch_assoc();
    if(password_verify($pass, $row['pass']))  
    {
        session_start();
        $sql="SELECT stu_id,name,reg_no,email,con_no,dept FROM stu_det WHERE reg_no='".$reg_no."'";
        $res=$link->query($sql);
        //fetching a row of the result
        $row = $res->fetch_assoc();
        $_SESSION['stu_id']=$row['stu_id'];
        $_SESSION["name"] = $row['name'];
        $_SESSION["reg_no"] = $row['reg_no'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["con_no"] = $row['con_no'];
        $_SESSION["dept"] = $row['dept'];
        $_SESSION["flag"]=1;
        header('Location:examples/dashboard.php');
    }
    else
    {
        header('Location:index.html');
    }
    }
    else if(isset($_POST['admin']))
    {
        $sql="SELECT pass FROM adm_det WHERE reg_no='".$reg_no."'";
    //result fetched for the query
    $res=$link->query($sql);
    //fetching a row of the result
    $row = $res->fetch_assoc();
    if(password_verify($pass, $row['pass']))  
    {
        session_start();
        $sql="SELECT adm_id,name,reg_no,email,con_no,dept FROM adm_det WHERE reg_no='".$reg_no."'";
        $res=$link->query($sql);
        //fetching a row of the result
        $row = $res->fetch_assoc();
        $_SESSION['adm_id']=$row['adm_id'];
        $_SESSION["name"] = $row['name'];
        $_SESSION["reg_no"] = $row['reg_no'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["con_no"] = $row['con_no'];
        $_SESSION["dept"] = $row['dept'];
        $_SESSION["flag"]=1;
        header('Location:admin/admin.php');
    }
    else
    {
        header('Location:index.html');
    }
        
    }
}
?>
