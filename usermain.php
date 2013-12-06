<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==0)
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
                <link rel="stylesheet" href="css/tabletheme.css"  type="text/css"/>
		
                <script src="jq/jquery-1.10.1.min.js"></script>
                <script src="js/alertbox.js"></script>
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
	
    <script src="bootstrap/js/bootstrap.js"></script>
	<div class="container">
    
	<?php include_once('user_header.html');?>
 <legend>Gadget Details</legend>
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
  
  echo "<table class=\"table table-bordered\"><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th><th>Received Date</th><th>Status</th><th>Comments</th>";
  
  if($result === FALSE) 
  {
    die(mysql_error()); // TODO: better error handling
  }
  
  while($row = mysqli_fetch_array($result))
    {
      $c+=1;
	  echo "<tr><td>".$c."</td><td>".$row['gadget_type']."</td><td>".$row['gadget_name']."</td><td>".$row['model_no']."</td><td>".$row['sl_no']."</td><td>".$row['rcvd_date']."</td><td>".$row['status']."</td><td>".$row['comment']."</td></tr>";
    }
  echo "</table>";
   }
  else
   {
    header('Location:login.php');
   }  
?>
<a href=addnewgadget.php><h4>Add New</h4></a>
  </div>      		
	</body>
</html>