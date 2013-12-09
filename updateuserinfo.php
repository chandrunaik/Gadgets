<?php
$id=$_POST['id'];
$value=$_POST['value'];
$arr=  explode("_", $id);
$uid=$arr[0];
$option=$arr[1];
$con=mysqli_connect("localhost","root","root","gadget");
if(mysqli_connect_errno())
  {
  echo "Failed to connect";// . mysqli_connect_error();
  }
 mysqli_select_db($con, "user");
 switch ($option)
 {
 case 1:
         mysqli_query($con,"UPDATE user SET doj='$value' WHERE user_id='$uid'");
         print $value;
         break;
 case 2:
         mysqli_query($con,"UPDATE user SET designation='$value' WHERE user_id='$uid'");
         print $value;
         break; 
 case 3:
         mysqli_query($con,"UPDATE user SET mobile='$value' WHERE user_id='$uid'");
          print $value;
         break;
 case 4:
         mysqli_query($con,"UPDATE user SET office='$value' WHERE user_id='$uid'");
          print $value;
         break;
 case 5:
         mysqli_query($con,"UPDATE user SET email='$value' WHERE user_id='$uid'");
          print $value;
          break;
/*
 *case 6:
         mysqli_query($con,"UPDATE user SET first_name='$value' WHERE user_id='$uid'");
          print $value;
          break;
 
 */
     default :
             break;
 }      
   mysqli_close($con);