<?php session_start();?>
<!DOCTYPE html>
<html>

	<head>
        	<meta charset="utf-8"/>
        	<title>:: Add new item to list ::</title>
                <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    		<link rel="stylesheet" href="js/jquery-ui.css">
                <script src="js/jquery-1.9.1.js"></script>
                <script src="js/jquery-ui.js"></script>
               
                
<script>
    function tempAlert(msg,duration)
    {
     var el = document.createElement("h4");
    el.setAttribute("style","position:absolute;z-index:999;top:40%;left:40%;background-color:white;color:teal;text-align:center;box-shadow:0px 0px 5px 1px Orange;border:5px solid Red;padding:5px 10px;");
    el.innerHTML = msg;
    setTimeout(function(){
    el.parentNode.removeChild(el);
     },duration);
    document.body.appendChild(el);
}
</script>

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
</style>

</head>
	
<body>
	
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
 // mysqli_close($con);
 echo "<script>tempAlert(\"New item added\",2000);</script>"; 
 echo "<script>setTimeout(\"location.href = 'adminpage.php';\",1500);</script>";
}
}
else
{
header('Location:login.php');
}
?>
   <script src="bootstrap/js/bootstrap.js"></script>
  	
	<div class="container">
	    <?php include_once('admin_header.html');?>
       <form method="post" action="addnewgadgeta.php" class="form">
		<table align="center">
           <legend>Enter Item Details</legend>
		   
			<tr><td>Gadget Type:</td>
			<td><select name="gtype">
			<?php 
                          $sql = mysqli_query($con,"SELECT * FROM type");
                          while ($row = mysqli_fetch_array($sql))
						  {
                          echo "<option value=\"".$row['type_name']."\">" . $row['type_name'] . "</option>";
						  }
			?>
			</select></td></tr>
			<tr><td>Gadget Name:</td>
			<td><input type="text" name="gname" required/></td></tr>
		    <tr><td>Model Number:</td>
			<td><input type="text" name="modnum" required/></td></tr>
			<tr><td>Serial Number:</td>
			<td><input type="text" name="slnum" required/></td></tr>
			<tr><td>Received Date:</td>
			<td><input type="text" id="datepicker" name="rdate" required readonly="readonly" style="background:white;cursor:auto"></td></tr>
			<tr><td>Item Status:</td>
			<td><select name="status">
			<?php 
                          $sql = mysqli_query($con,"SELECT * FROM status");
                          while ($row = mysqli_fetch_array($sql))
						  {
                          echo "<option value=\"".$row['status_name']."\">" . $row['status_name'] . "</option>";
						  }
		    mysqli_close($con);
			?></select></td></tr>
			<tr><td>Comment:</td>
			<td><input type="text" name="comment" required/></td></tr>
			<tr><td></td><td><button class="btn btn-success" id="submit" type="submit" name="submit">ADD</button></td></tr>			
		</table></form>
		     <hr>
			<a href="adminpage.php"><b> &lt;&lt; &nbsp; Go Back &nbsp;&lt;&lt;</br></a>
		
	</div>
       
	</body>
</html>