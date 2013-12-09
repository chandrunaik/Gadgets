<?php
$con = mysqli_connect('localhost','root','root','gadget');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"user");
$sql="SELECT * FROM user";

$result = mysqli_query($con,$sql);

echo "<table class=\"table table-bordered\" id=\"testTable\"><thead><th>#</th><th>Name</th><th>DoJ</th><th>Designation</th><th>Mobile Number</th><th>Office Number</th><th>Email</th></thead><tbody>";
  
$c=0;
 while($row = mysqli_fetch_array($result))
  {
       $c+=1;
	  echo "<tr><td>".$c."</td>"
                  ."<td><a href=\"javascript:viewgadgetsbyuser(".$row['user_id'].");\"><b>".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</b></a></td>"
                  ."<td class=\"doj\" id=\"".$row['user_id']."_1"."\">".$row['doj']."</td>"
                  ."<td class=\"desg\" id=\"".$row['user_id']."_2"."\">".$row['designation']."</td>"
                  ."<td class=\"mobile\" id=\"".$row['user_id']."_3"."\">".$row['mobile']."</td>"
                  ."<td class=\"office\" id=\"".$row['user_id']."_4"."\">".$row['office']."</td>"
                  ."<td class=\"email\" id=\"".$row['user_id']."_5"."\">".$row['email']."</td></tr>";
  }
echo "</tbody></table>";

mysqli_close($con);
?>