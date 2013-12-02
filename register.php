<!DOCTYPE html>
<html>

	<head>
	    
		<meta http-equiv="cache-control" content="no-cache" />
		 
		<meta charset="utf-8"/>
		
		<title>::login/register::</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css"  type="text/css"/>
		<link href="css/style.css" rel="stylesheet" />	
	    
		<script src="js/alertbox.js"></script>
	</head>
	
<body>
         <script src="jq/jquery-1.10.1.min.js"></script>
         <script src="bootstrap/js/bootstrap.js"></script>
<?php
if(isset($_POST['submit'])) 
{
 $name = test_input($_POST['name']);
 $email = test_input($_POST['email']);
 $password = test_input($_POST['password']);

 $con=mysqli_connect("localhost","root","root","gadget");

 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 exit();
 }
  
 $result =mysqli_query($con,"SELECT user.email FROM user WHERE email='$email'");

 if((mysqli_num_rows($result))==0)
 {
 $sql="INSERT INTO user (user_name, email, password) VALUES('$name','$email','$password')";

 if(!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
   exit();
  }
echo "<script>tempAlert(\"Registration successful, please login to continue.\",4000);</script>";  
//header('Location:login.php');
 }
 elseif((mysqli_num_rows($result))==1)
 {
  echo "<script>tempAlert(\"Email address already exists. Please try other. \",4000);</script>"; 
 } 
 mysqli_close($con);
}
function test_input($data)
{
  $data = chop($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
		<form id="login-register" method="post" action="register.php">
				
			<h2>REGISTER </h2>
            
			<input id="name" "type="text" placeholder="Enter your name" name="name" required/>
			
			<input id="email" type="email" placeholder="your@email.com" name="email" required/>
			
			<input id="password" type="password" placeholder="Password" name="password" required />
			<p id="err" style="color:red"></p>
			<button id="submit" name="submit">REGISTER</button><br><br><a href="login.php"><h4>Already registered? Login</h4></a>
		
		</form>
       
	</body>
</html>