<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==0)
{
    //header('Location:login.php');
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
                    span#errmsg
                    {
                    color:red;
                    font-weight:bold;
                    }
</style>
</head>
	
<body>
	
<?php 
$con=mysqli_connect("localhost","root","root","gadget");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if(isset($_SESSION['uid']))
{
    $perr="";
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
    if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$rcvddate))
                        {
                         $perr = "Enter in \"YYYY-MM-DD\" format";
                         $k="";
                        }	
                       else 	
                       {$k=1;}
 if($k==1)
 {                  
 
$sql="INSERT INTO gadgetlist(user_id,gadget_type,gadget_name,model_no,sl_no,rcvd_date,status,comment)
VALUES('$id','$gtype','$gname','$modelno','$slno','$rcvddate','$status','$comment')";

 if (!mysqli_query($con,$sql))
  {
  //echo $_POST['status'];
  die('Error: ' . mysqli_error($con));
  }
 // mysqli_close($con);
 echo "<script>tempAlert(\"New item added\",2000);</script>"; 
 echo "<script>setTimeout(\"location.href = 'usermain.php';\",1500);</script>";
}
 else 
 {
     
 }
   
 }
}
else
{
header('Location:login.php');
}
?>
   <script src="bootstrap/js/bootstrap.js"></script>
  	
	<div class="container">
	    <?php include_once('user_header.html');?>
          
		
           <form method="post" action="addnewgadget.php" class="form">
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
                            <td><input type="text" id="datepicker" name="rdate" required><span id="errmsg">&nbsp;&nbsp;<?php echo $perr;?></span></td></tr>
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
			<td><input type="text" name="comment"/></td></tr>
			<tr><td></td><td><button class="btn btn-info" id="submit" type="submit" name="submit">&nbsp;&nbsp;Add&nbsp;&nbsp;</button></td></tr>			
		
	<fieldset>
		
		
	</table></form>
            <legend></legend>
			<a href="usermain.php"><b>Go Back</a>
		
	</div>
       
	</body>
</html>