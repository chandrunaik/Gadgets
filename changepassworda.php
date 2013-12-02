<?php session_start();?>
<!DOCTYPE html>
<html>

	<head>
	       <meta charset="utf-8"/>
		<title>::login/register::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>	
	
<script>
function tempAlert(msg,duration)
{
 var el = document.createElement("h4");
 el.setAttribute("style","position:absolute;z-index:999;top:40%;left:40%;background-color:white;color:Orange;text-align:center;box-shadow:0px 0px 5px 1px Orange;border:5px solid Red;padding:5px 10px;");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
}
</script>
        </head>
<body>	
<?php 
if(isset($_SESSION['uid']))
{
  if(isset($_POST['submit']))
     {
	   $id=$_SESSION['uid'];
	   $name=$_POST['name'];
	   $pname=$_POST['pname'];
	   $cname=$_POST['cname'];
        if($pname==$cname)
         {
          $con=mysqli_connect("localhost","root","root","gadget");
        
          if(mysqli_connect_errno())
            {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		    }
		    $result = mysqli_query($con,"SELECT password FROM user WHERE user_id='$id'");
       
	        while($row = mysqli_fetch_array($result))
             {
              if($row['password']==$_POST['name'])
	             {
	               mysqli_query($con,"UPDATE user SET password='$_POST[pname]' WHERE user_id='$_SESSION[uid]'");
	               echo "<script>tempAlert(\"Password updated successfully\",4000);</script>";
	             }
                 else
                 {
			      echo "<script>tempAlert(\"Invalid current password\",4000);</script>";  
			     } 
             } 
         }
         else
         {
           echo "<script>tempAlert(\"Password does not match\",4000);</script>";  
         }
     }
}	 
      else
     {
       header('Location:login.php');
      }

?>
   <script src="jq/jquery-1.10.1.min.js"></script>
<!--add bootstrap-->
  <script src="bootstrap/js/bootstrap.js"></script>
  	
<div class="container" >
	<?php include_once('admin_header.html');?>
<table align="center">
       <form method="post" action="changepassworda.php">
	     <legend>Enter Details</legend>
		 <tr><td>Current password:</td>
		 <td><input id="name" type="password" name="name" required/></td></tr>
         <tr><td>New password:</td>
		 <td><input id="name" type="password" name="pname" required/></td></tr>
		 <tr><td>Confirm password:</td>
		 <td><input id="name" type="password" name="cname" required/></td></tr>
		<tr><td></td><td><button class="btn btn-success" id="submit" type="submit" name="submit">Change password</button></td></tr>
</table> 

<hr>
		<a href="adminpage.php"><b> &lt;&lt; &nbsp; Go Back &nbsp;&lt;&lt;</br></a>
		
	  </form>
</div>
       
</body>
</html>