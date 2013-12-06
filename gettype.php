<?php 
$con = mysqli_connect('localhost','root','root','gadget');
if (!$con)
  {
  die('Could not connect'); // :'. mysqli_error($con));
  }

mysqli_select_db($con,"type");
$sql = mysqli_query($con,"SELECT * FROM type");
     while ($row = mysqli_fetch_array($sql))
     {   
	$array[$row['type_name']]=$row['type_name'];		  
                
     }
     print json_encode($array);