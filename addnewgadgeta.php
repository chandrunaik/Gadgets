<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==1)
{
    header('Location:login.php');
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
        	<title>:: Add new item to list ::</title>
                <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    		<link rel="stylesheet" href="js/jquery-ui.css">
                <script src="js/jquery-1.9.1.js"></script>
                <script src="js/jquery-ui.js"></script>
                <script src="js/alertbox.js" type="text/javascript"></script>
                
<script>
$(function() {
$( "#datepicker" ).datepicker({
changeMonth: true,
changeYear: true,
showOn: "button",
buttonImage: "img/calendar.gif",
buttonImageOnly: true
});
$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
});
</script>
<style>
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
                        // font-weight: bold;
                         padding-bottom:10px;
                        font-family:Verdana;
                    }
                     .container
                    {
                        width:80%;
                    }
</style>

</head>
	

	
<?php 
if(isset($_SESSION['uid']))
{
   
   $con=mysqli_connect("localhost","root","root","gadget");

// Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
if(isset($_POST['submit'])) 
	{
$id=$_SESSION['uid'];
$gtype=$_POST['gtype'];
$gname=$_POST['gname'];
$modelno=$_POST['modnum'];
$slno=$_POST['slnum'];
$rcvddate=$_POST['rdate'];
$status=$_POST['status'];
$comment=$_POST['comment'];

$con=mysqli_connect("localhost","root","root","gadget");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="INSERT INTO gadgetlist(user_id,gadget_type,gadget_name,model_no,sl_no,rcvd_date,status,comment)
VALUES('$id','$gtype','$gname','$modelno','$slno','$rcvddate','$status','$comment')";

 if (!mysqli_query($con,$sql))
  {
  //echo $_POST['status'];
  die('Error: ' . mysqli_error($con));
  }
  echo "<script>tempAlert(\"Added successfully\",2000);</script>";
  echo "<script>setTimeout(\"location.href = 'addnewgadgeta.php';\",1500);</script>";
}
}
else
{
header('Location:login.php');
}
?>
<body>

	<div class="container">
	    <?php include_once('admin_header.html');?>
        <form method="post" action="addnewgadgeta.php" class="form">
		<table align="center">
           <legend>Enter Item Details</legend>
		   
			<tr><td class="trtd">Gadget Type:</td>
			<td><select name="gtype">
			<?php 
                          $sql = mysqli_query($con,"SELECT * FROM type");
                          while ($row = mysqli_fetch_array($sql))
						  {
                          echo "<option value=\"".$row['type_name']."\">" . $row['type_name'] . "</option>";
						  }
			?>
			</select></td></tr>
                        <tr><td class="trtd">Gadget Name:</td>
			<td><input type="text" name="gname" required/></td></tr>
		        <tr><td class="trtd">Model Number:</td>
			<td><input type="text" name="modnum" required/></td></tr>
			<tr><td class="trtd">Serial Number:</td>
			<td><input type="text" name="slnum" required/></td></tr>
			<tr><td class="trtd">Received Date:</td>
			<td><input type="text" id="datepicker" name="rdate" required readonly="readonly" style="background:white;cursor:auto"></td></tr>
			<tr><td class="trtd">Item Status:</td>
			<td><select name="status">
			<?php 
                          $sql = mysqli_query($con,"SELECT * FROM status");
                          while ($row = mysqli_fetch_array($sql))
						  {
                          echo "<option value=\"".$row['status_name']."\">" . $row['status_name'] . "</option>";
						  }
		    mysqli_close($con);
			?></select></td></tr>
			<tr><td class="trtd">Comment:</td>
			<td><input type="text" name="comment" required/></td></tr>
			<tr><td></td><td><button class="btn btn-success" id="submit" type="submit" name="submit">ADD</button></td></tr>			
		</table></form>
            <legend></legend>
			<a href="adminpage.php"><b> &lt;&lt; &nbsp; Go Back &nbsp;&lt;&lt;</br></a>
		
	</div>
       
	</body>
</html>