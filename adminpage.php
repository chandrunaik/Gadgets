<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
	        <meta charset="utf-8"/>
		<title>::login/register::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<script src="js/alertbox.js"></script>
          
                <!-- Data tables and Jeditable -->
                
                <script src="jquery_tables/js/jquery.min.js"></script>
                <script src="jquery_tables/js/jquery.datatables.js"></script>
                <script src="jquery_tables/js/jquery.jeditable.js"></script>
                
    <script>
   $(document).ready( function () {
		$('#admintable').dataTable().makeEditable({
							sUpdateURL: "updateadminpage.php"
							});
}
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
 
  echo "<table class=\"table table-bordered\" id=\"admintable\">
        <legend>Item Details</legend>
        <thead><tr><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th>
        <th>Received Date</th><th>Status</th><th>Comments</th><th></th></tr></thead></tbody>";
  
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