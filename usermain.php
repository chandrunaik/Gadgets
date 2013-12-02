<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="cache-control" content="no-cache" />
		<meta charset="utf-8"/>
		<title>::login/register::</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700/css/bootstrap.css"  type="text/css"/>	
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<script src="js/alertbox.js"></script>
		</head>
<body>
	<script src="jq/jquery-1.10.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
	<div class="container">
    
	<?php include_once('user_header.html');?>

<?php 
  if(isset($_SESSION['uid']))
   {
   $id=$_SESSION['uid'];
   $con=mysqli_connect("localhost","root","root","gadget");
   // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 
  $c=0;
  $result = mysqli_query($con,"SELECT gadget_type,gadget_name,model_no,sl_no,rcvd_date,status,comment from gadgetlist WHERE user_id='$id'");
  echo "<h4 style=\"color:Teal\"><i>  <i></h4>
  <a href=\"addnewgadget.php\"><h4>Add New</h4></a>";
  echo "<table class=\"table table-bordered\"><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th><th>Received Date</th><th>Status</th><th>Comments</th>";
  
  if($result === FALSE) 
  {
    die(mysql_error()); // TODO: better error handling
  }
  
  while($row = mysqli_fetch_array($result))
    {
      $c+=1;
	  echo "<tr><td>".$c."</td><td>".$row['gadget_type']."</td><td>".$row['gadget_name']."</td><td>".$row['model_no']."</td><td>".$row['sl_no']."</td><td>".$row['rcvd_date']."</td><td>".$row['status']."</td><td>".$row['comment']."</td><td>Edit</td></tr>";
    }
  echo "</table><hr><a href=\"addnewgadget.php\"><h4>Add New</h4></a>";
   }
  else
   {
    header('Location:login.php');
   }  
?>
  </div>      		
	</body>
</html>