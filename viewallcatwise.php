<?php
$q = (string)($_GET['q']);

$con = mysqli_connect('localhost','root','root','gadget');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"gadgetlist");
if($q=="viewall")
{
$sql="SELECT * FROM gadgetlist";

$result = mysqli_query($con,$sql);

echo "<table class=\"table table-bordered\"><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th><th>Received Date</th><th>Status</th><th>Comments</th>";
  
$c=0;
 while($row = mysqli_fetch_array($result))
  {
       $c+=1;
	  echo "<tr><td>".$c."</td><td>".$row['gadget_type']."</td><td>".$row['gadget_name']."</td><td>".$row['model_no']."</td><td>".$row['sl_no']."</td><td>".$row['rcvd_date']."</td><td>".$row['status']."</td><td>".$row['comment']."</td></tr>";

}
}
else
{
$sql="SELECT * FROM gadgetlist WHERE gadget_type='".$q."'";

$result = mysqli_query($con,$sql);

echo "<table class=\"table table-bordered\"><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th><th>Received Date</th><th>Status</th><th>Comments</th>";
  
$c=0;
 while($row = mysqli_fetch_array($result))
  {
       $c+=1;
	  echo "<tr><td>".$c."</td><td>".$row['gadget_type']."</td><td>".$row['gadget_name']."</td><td>".$row['model_no']."</td><td>".$row['sl_no']."</td><td>".$row['rcvd_date']."</td><td>".$row['status']."</td><td>".$row['comment']."</td></tr>";

  }
echo "</table>";
}
mysqli_close($con);
?>