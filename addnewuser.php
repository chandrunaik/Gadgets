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
		<title>::  Adding new user  ::</title>
                <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    		<link rel="stylesheet" href="js/jquery-ui.css">
                <script src="js/jquery-1.9.1.js"></script>
                <script src="js/jquery-ui.js"></script>
                <script src="js/alertbox.js"></script>
<script>
$(function()
{
$( ".datepicker" ).datepicker({ 
changeMonth: true,
changeYear: true,
showOn: "button",
buttonImage: "img/calendar.gif",
buttonImageOnly: true
});
$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
$("#doltr").hide();
$("#chkdol").click(function()
{
$("#doltr").toggle();
});
});
</script>

              <style>
                     tr td span
                     {
                        margin-left:5px;
                        color:Red;
                      }
                    .ui-widget-content .ui-icon {
                          background-image: url(img/ui-icons_222222_256x240.png);
                        }
                    body{
                        background-image: url('img/innerbackgrnd.png'); 
                        background-repeat:repeat;
                                            }
                    legend{color:white;}
                   
                    .trtd
                    {
                         color:white;
                       //  font-weight: bold;
                         padding-bottom:10px;
                         font-family:Calibri;
                         font-family:Verdana;
                    }
                     .container
                    {
                        width:80%;
                    }
            </style>
</head>
	
<body>

<?php
if(isset($_SESSION['uid']))
{
$ferr=$moberr=$lerr=$derr=$merr=$oerr=$aerr=$perr=$dojerr=$dolerr="";
if(isset($_POST['submit'])) 
{
$fname=protect($_POST['fname']);
$mname=protect($_POST['mname']);
$lname=protect($_POST['lname']);
$doj=protect($_POST['doj']);
$desg=protect($_POST['designation']);
$mobile=protect($_POST['mobilenum']);
$offnum=protect($_POST['officenum']);
$altnum=protect($_POST['altnum']);
$email=protect($_POST['email']);
$password=protect($_POST['password']);
$rolee=$_POST['role'];
$role=(string)$rolee;
if(isset($_POST['dol']))
{
$dol=  protect($_POST['dol']);
}
else
{
$dol='NULL';
}
$con=mysqli_connect("localhost","root","root","gadget");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: ";// . mysqli_connect_error();
  }
                   if(!preg_match("/^[a-zA-Z]*$/",$fname))
                    {
                     $ferr = "Only letters allowed";
                      $a="";
                    }
                    else
                    {
                    $a=1;
                    }
	           if(!empty($mname))
	   	    {
		      if (!preg_match("/^[a-zA-Z]*$/",$mname))
                       {
                         $merr = "Only letters allowed";
                         $b=$c="";
                       } 
                       else
                       {
                         $b=$c=1;  
                       }
		   }
                   else
                   {
                       $b=$c=1;
                   }
                   if(!empty($lname))
		    {
		       if (!preg_match("/^[a-zA-Z]*$/",$lname))
                        {
                        $lerr = "Only letters allowed";
                         $d=$e="";
		        }
	                else 
                        {
                            $d=$e=1;
                        }
                    }
                    else
                    {
                        $d=$e=1;
                    }
                    
                    if(!preg_match("/^[a-zA-Z ]*$/",$desg))
                   {
                   $derr = "Only letters allowed";
                    $f="";
                   }
                   else 
                   {
                    $f=1;
                   }
	           
                   if(!preg_match("/^[0-9]{10}+$/",$mobile))
                   {
                       $moberr= "Enter 10 digit mobile number";
                       $e="";
                   }
                   else 
                   {
                    $e=1;
                   }
                 if(!empty($offnum))
	   	  {
		   if (!preg_match("/^[0-9]{1,15}+$/",$offnum))
                     {
                      $oerr = "Only Numbers allowed";
                      $f=$g="";
                     }
                     else
                     {
                     $f=$g=1;
                     }
                    }
                  else
                   {
                     $f=$g=1; 
                    }
                    
                 if(!empty($altnum))
	   	  {
		    if (!preg_match("/^[0-9]{1,15}+$/",$altnum))
                     {
                      $aerr = "Only Numbers allowed";
                      $h=$i="";
                     }
	              else 
		      {$h=$i=1;}
                  }
                  else 
		   {$h=$i=1;}
                   
		if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$doj))
                   {
                      $dojerr = "Enter in \"YYYY-MM-DD\" format";
                      $j="";
                    }
                    else 
		      {$j=1;}
                      
		if(!empty($dol))
	   	   {
		     if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$dol))
                        {
                         $dlerr = "Enter in \"YYYY-MM-DD\" format";
                         $k=$l="";
                        }	
                     else 	
                   {$k=$l=1;}
                    }
                   else 
		      {$k=$l=1;}
	    
		if (!preg_match("/^[0-9a-zA-Z]{5,254}$/",$password))
                   {
                     $perr="Minimum 5 characters";
                     $m="";
                   }
                   else
                   {$m=1;}
                   
             if($a==1 && $b==1 && $c==1 && $d==1 && $e==1 && $f==1 && $g==1 && $h==1 && $i==1 && $j==1 && $k==1 && $l==1 && $m==1)
              {
              $sql="INSERT INTO user(first_name,middle_name,last_name,doj,
              designation,dol,mobile,office,alternate,email,password,role)
              VALUES('$fname','$mname','$lname','$doj','$desg',"
              . "" . ($dol==NULL ? "NULL" : "'$dol'") . ",'$mobile',"
              . "". "'$offnum','$altnum','$email','$password','$role')";

                 if (!mysqli_query($con,$sql))
                  {
                         die('Error: ' . mysqli_error($con));
                  }
$fname="";
$mname="";
$lname="";
$doj="";
$dol="";
$desg="";
$mobile="";
$offnum="";
$altnum="";
$email="";
$password="";
              echo "<script>tempAlert(\"Successfully added\",3000);</script>"; 
             echo "<script>setTimeout(\"location.href = 'addnewuser.php';\",1500);</script>";
              }
              else
              {
            // echo "<script>tempAlert(\"Please fill valid entries\",2000);</script>"; 
              
              }
 }
 else
 {
$fname="";
$mname="";
$lname="";
$doj="";
$dol="";
$desg="";
$mobile="";
$offnum="";
$altnum="";
$email="";
$password="";
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
   <script src="bootstrap/js/bootstrap.js"></script>
  	
	<div class="container">
	    <?php include_once('admin_header.html');?>
               
		  <form method="post" action="addnewuser.php" class="form">
		   <table align="center">
		    <legend>Enter User Details</legend>
		
                     <tr><td class="trtd">First Name:</td>
			<td><input type="text" name="fname" required value="<?php echo $fname;?>"><span><?php echo $ferr;?></span></td></tr>
			
			<tr><td class="trtd">Middle Name:</td>
			<td><input type="text" name="mname" value="<?php echo $mname;?>"><span><?php echo $merr;?></span></td></tr>
			
		        <tr><td class="trtd">Last Name:</td>
			<td><input type="text" name="lname" value="<?php echo $lname;?>"><span><?php echo $lerr;?></span></td></tr>
			
			<tr><td class="trtd">Designation:</td>
			<td><input type="text" name="designation" required value="<?php echo $desg;?>"><span><?php echo $derr;?></span></td></tr>
			
		        <tr><td class="trtd">Mobile Number:</td>
			<td><input type="text" name="mobilenum" required placeholder="10 digit number" value="<?php echo $mobile;?>"><span><?php echo $moberr;?></span></td></tr>
			
			<tr><td class="trtd">Office Number:</td>
			<td><input type="text" name="officenum" value="<?php echo $offnum;?>"><span><?php echo $oerr;?></span></td></tr>
			
			<tr><td class="trtd">Alternate Number:</td>
			<td><input type="text" name="altnum" value="<?php echo $altnum;?>"><span><?php echo $aerr;?></span></td></tr>
			
			<tr><td class="trtd">Date of Joining:</td>
			<td><input type="text" class="datepicker" name="doj" required placeholder="yyyy-mm-dd" value="<?php echo $doj;?>"><span><?php echo $dojerr;?></span></td></tr>
			
			<tr><td class="trtd">Email:</td>
			<td><input type="email" name="email" required value="<?php echo $email;?>"></td></tr>
			
			<tr><td class="trtd">Password:</td>
			<td><input type="text" name="password" required value="<?php echo $password;?>"><span><?php echo $perr;?></span></td></tr>
			
                        <tr><td class="trtd">Role:</td><td><select name="role"><option selected="selected" value="user">USER</option><option value="admin">ADMIN</option></select></td></tr>
                       
                        <tr><td></td><td><p id="chkp"><input type="checkbox" id="chkdol" name="dol">&nbsp;&nbsp;&nbsp;<span class="trtd">Mention Date of Termination</span></td></p></tr>
			
			<tr id="doltr"><td class="trtd">Date of Termination:</td>
			<td><input type="text" class="datepicker" name="dol" readonly="readonly" style="background:white;cursor:auto" value="<?php echo $dol;?>"><span><?php echo $dolerr;?></span></td></tr>
			
			<tr><td></td><td><button class="btn btn-small btn-success" style="width:100px" id="submit" type="submit" name="submit">ADD</button></td></tr>			
		</table>
		</form>
		
	
            <legend></legend>
			<a href="adminpage.php"><b>Go Back</a>
		
	</div>
       
	</body>
</html>