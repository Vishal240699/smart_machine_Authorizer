<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family:Roboto, sans-serif;
  background-repeat:  no-repeat;
  background-size: fixed;
  background-image: url('https://wallpaperaccess.com/full/1728957.jpg');
  background-image: center;
  position:fixed;
  top: 50%;
  left: 50%;
  overflow: auto;
  height: 50px;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
  border-radius: 10px;
    margin-top: -285px;
    margin-left: 68px;
    opacity: 0.95;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1; 
  border-radius: 15px;
}

input[type=text]:focus, input[type=password]:focus {
  background-color:#7AD7F0 ;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4BA4E8;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border-left: 6px solid skyblue;
  
  cursor: pointer;
  width: 100%;
  
}

.registerbtn:hover {
  opacity: 0.5;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
  border-radius: 10px;
}

.reset-password {
  width: 45vw;
  border-radius: 10px;
    margin-left: -680px;
}

</style>
</head>
<body>

<form action="/action_page.php" class="reset-password">
  <div class="container" style="align-content: center">
    <h1>Register</h1>
    <p>Please fill in this form to create new password.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    <hr>
      <p>Already have an account <a href="../index.html"><U>Sign in</U></a>.</p>

    <button type="submit" class="registerbtn">Reset Passsword</button>
  </div>

<!--
  <div class="container signin">
    <p>Already have an account? <a href="../index.html">Sign in</a>.</p>
  </div>
-->
</form>

</body>
</html>
