<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==1)
{
   // header('Location:login.php');
    ob_end_flush();
    exit();   
}
elseif(!(isset($_SESSION['uid'])))
{
    header('Location:login.php');
    ob_end_flush();
    exit();
}?>
<!DOCTYPE html>
<html>
     <head>
	       <meta charset="utf-8"/>
		<title>::login/register::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>	
                <script src="js/alertbox.js" type="text/javascript"></script>
                <style>
                     body{
                        background-image: url('img/innerbackgrnd.png'); 
                        background-repeat:repeat;
                    }
                    legend 
                    {
                        color:white;
                    }
                    tr td:first-child
                    {
                         color:white;
                        // font-weight: bold;
                         padding-bottom:10px;
                         font-family:Verdana;
                    }
                    .container
                    {
                        width:80%;
                    }
                    span{
                        color:red;
                    }
                    
                </style>
     </head>
<body>	
<?php 
if(isset($_SESSION['uid']))
{
    $ferr="";
  if(isset($_POST['submit']))
     {
	   $id=  protect($_SESSION['uid']);
	   $name=  protect($_POST['name']);
	   $pname=  protect($_POST['pname']);
	   $cname=  protect($_POST['cname']);
           if(!preg_match("/^[a-zA-Z0-9]{5,254}$/",$pname))
               {
                 $ferr = "minimum 5 letters/number required";
                 $a="";
               }
               else
               {
                 $a=1;
               }
             if($a==1)
             {
           if($pname==$cname )
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
                       echo "<script>setTimeout(\"location.href = 'adminpage.php';\",1500);</script>";
	             }
                 else
                     {
			      echo "<script>tempAlert(\"Invalid current password\",4000);</script>";  
                              echo "<script>setTimeout(\"location.href = 'changepassworda.php';\",1500);</script>";
	             } 
               } 
         }
         else
         {
           echo "<script>tempAlert(\"Password does not match\",4000);</script>";
           echo "<script>setTimeout(\"location.href = 'changepassworda.php';\",1500);</script>";
         }
         }
         else { }
         
     }
}	 
      else
     {
       header('Location:login.php');
      }
 function protect($value){
 $con=mysqli_connect("localhost","root","root","gadget");
  return mysqli_real_escape_string($con,trim(strip_tags($value)));
}

?>
   <script src="jq/jquery-1.10.1.min.js"></script>
<!--add bootstrap-->
  <script src="bootstrap/js/bootstrap.js"></script>
  	
<div class="container" >
	<?php include_once('admin_header.html');?>
    <form method="post" action="changepassworda.php">
          <table align="center">
       
	         <legend>Enter Details</legend>
		
                 <tr><td>Current password:</td>
		     <td><input id="name" type="password" name="name" required/></td></tr>
                 <tr><td>New password:</td>
                     <td><input id="name" type="password" name="pname" required/><span><?php echo $ferr; ?></span></td></tr>
		 <tr><td>Confirm password:</td>
		     <td><input id="name" type="password" name="cname" required/></td></tr>
		 <tr><td></td><td><button class="btn btn-success" id="submit" type="submit" name="submit">Change password</button></td></tr>
          </table> 
      </form>
        <legend>
        </legend>
        
     <a href="adminpage.php"><b> &lt;&lt; &nbsp; Go Back &nbsp;&lt;&lt;</br></a>
		
	 
</div>
       
</body>
</html>