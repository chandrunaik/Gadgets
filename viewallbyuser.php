<?php
$q = intval($_GET['userid']);

$con = mysqli_connect('localhost','root','root','gadget');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"gadgetlist");
$sql="SELECT * FROM gadgetlist WHERE user_id='".$q."'";

$result = mysqli_query($con,$sql);

   echo "<table class=\"table table-bordered\" id=\"testTable\">
        <legend><span id=\"tblheading\">Item Details</span></legend>
        <thead><tr><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th>
        <th>Received Date</th><th>Status</th><th>Comments</th></tr></thead></tbody>";
//echo "<table class=\"table table-bordered\" id=\"testTable\"><thead><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th><th>Received Date</th><th>Status</th><th>Comments</th></thead><tbody>";
  
$c=0;
 while($row = mysqli_fetch_array($result))
  {
       //$c+=1;
	//  echo "<tr><td>".$c."</td><td>".$row['gadget_type']."</td><td>".$row['gadget_name']."</td><td>".$row['model_no']."</td><td>".$row['sl_no']."</td><td>".$row['rcvd_date']."</td><td>".$row['status']."</td><td>".$row['comment']."</td></tr>";
               $c+=1;
     	       echo "<tr>"
                  . "<td>".$c."</td>"
                  . "<td class=\"gt\" id=\"".$row['gadget_id']."_1"."\">".$row['gadget_type']."</td>"
                  . "<td class=\"gname\" id=\"".$row['gadget_id']."_2"."\">".$row['gadget_name']."</td>"
                  . "<td class=\"gmodel\" id=\"".$row['gadget_id']."_3"."\">".$row['model_no']."</td>"
                  . "<td class=\"gsl\" id=\"".$row['gadget_id']."_4"."\">".$row['sl_no']."</td>"
                  . "<td class=\"grd\" id=\"".$row['gadget_id']."_5"."\">".$row['rcvd_date']."</td>"
                  . "<td class=\"gst\" id=\"".$row['gadget_id']."_6"."\">".$row['status']."</td>"
                  . "<td class=\"gcomm\" id=\"".$row['gadget_id']."_7"."\">".$row['comment']."</td>"
                  . "</tr>";
  }
echo "</tbody></table>";

mysqli_close($con);
