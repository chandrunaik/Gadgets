<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	        <meta charset="utf-8"/>
		<title>::login/register::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<script src="js/alertbox.js"></script>
                <script src="jedit/jquery.jeditable.js"></script>
    <script>
    $(document).ready(function() {
         $('.gname').editable('jeditdemo.php', { 
         type      : 'text',
         cancel    : 'Cancel',
         submit    : 'OK',
    //     indicator : '<img src="img/indicator.gif">',
         tooltip   : 'Click to edit...'
     });
 });
    </script>
    <style>
        tr:hover
        {
            background-color: #F9FAFA;
        }
      </style>
  
		</head>
<body>
	<script src="jq/jquery-1.10.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
	<div class="container">
    
	<?php include_once('admin_header.html');?>
        <style>
		th
		{
		background-color:#C2C9C9;
		}
		</style>
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
  $result = mysqli_query($con,"SELECT gadget_id,gadget_type,gadget_name,model_no,sl_no,rcvd_date,status,comment from gadgetlist WHERE user_id='$id'");
 
  echo "<table class=\"table table-bordered\">
        <legend>Item Details</legend>
        <thead><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th>
        <th>Received Date</th><th>Status</th><th>Comments</th><th></th></thead></tbody>";
  
  if($result === FALSE) 
  {
    die(mysql_error()); // TODO: better error handling
  }
  
  while($row = mysqli_fetch_array($result))
    {
      $c+=1;
     
	  echo "<tr>"
                  . "<td>".$c."</td>"
                  . "<td>".$row['gadget_type']."</td>"
                  . "<td><div id=\"gname\" class=\"gname\">".$row['gadget_name']."</div></td>"
                  . "<td>".$row['model_no']."</td>"
                  . "<td>".$row['sl_no']."</td>"
                  . "<td>".$row['rcvd_date']."</td>"
                  . "<td>".$row['status']."</td>"
                  . "<td>".$row['comment']."</td>"
                  . "<td>Edit</td></tr>";
    }
  echo "</tbody></table><hr><a href=\"addnewgadgeta.php\"><h4>Add New</h4></a>";
   }
  else
   {
    header('Location:login.php');
   }  
?>
  </div>
  	</body>
</html>