<?php
$id=$_POST['id'];
$value=$_POST['value'];
$arr=  explode("_", $id);
$gid=$arr[0];
$option=$arr[1];
$con=mysqli_connect("localhost","root","root","gadget");
if(mysqli_connect_errno())
  {
  echo "Failed to connect";// . mysqli_connect_error();
  }
 mysqli_select_db($con, "gadgetlist");
 switch ($option)
 {
 case 1:
         mysqli_query($con,"UPDATE gadgetlist SET gadget_type='$value' WHERE gadget_id='$gid'");
         print $value;
         break;
 case 2:
         mysqli_query($con,"UPDATE gadgetlist SET gadget_name='$value' WHERE gadget_id='$gid'");
         print $value;
         break; 
 case 3:
         mysqli_query($con,"UPDATE gadgetlist SET model_no='$value' WHERE gadget_id='$gid'");
          print $value;
         break;
 case 4:
         mysqli_query($con,"UPDATE gadgetlist SET sl_no='$value' WHERE gadget_id='$gid'");
          print $value;
         break;
 case 5:
         mysqli_query($con,"UPDATE gadgetlist SET rcvd_date='$value' WHERE gadget_id='$gid'");
          print $value;
          break;
case 6:
         mysqli_query($con,"UPDATE gadgetlist SET status='$value' WHERE gadget_id='$gid'");
          print $value;
          break;
case 7:
         mysqli_query($con,"UPDATE gadgetlist SET comment='$value' WHERE gadget_id='$gid'");
          print $value;
          break;
     default :
             break;
 }      
         mysqli_close($con);