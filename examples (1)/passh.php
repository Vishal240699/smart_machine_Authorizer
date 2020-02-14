<?php
$to=$_POST['email'];
$randomid = mt_rand(100000,999999); 
$subject = 'RESET PASSWORD';
$message = "THE FOLLOWING NUMBER IS YOUR OTP TO RESET PASSWORD:{$subject}";
mail($to_email,$subject,$message);
header("Location:fotp.php")
?>