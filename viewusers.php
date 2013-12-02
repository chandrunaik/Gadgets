<?php
$con = mysqli_connect('localhost','root','root','gadget');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"user");
$sql="SELECT * FROM user";

$result = mysqli_query($con,$sql);

echo "<table class=\"table table-bordered\"><thead><th>#</th><th>Name</th><th>DoJ</th><th>Designation</th><th>Mobile Number</th><th>Office Number</th><th>Email</th></thead><tbody>";
  
$c=0;
 while($row = mysqli_fetch_array($result))
  {
       $c+=1;
	  echo "<tr><td>".$c."</td><td><a href=\"javascript:viewgadgetsbyuser(".$row['user_id'].");\"><b>".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</b></a></td><td>".$row['doj']."</td><td>".$row['designation']."</td><td>".$row['mobile']."</td><td>".$row['office']."</td><td>".$row['email']."</td></tr>";

  }
echo "</tbody></table>";

mysqli_close($con);
?>