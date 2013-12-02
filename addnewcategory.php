<?php session_start();?>
<!DOCTYPE html>
<html>

	<head>
	      <meta charset="utf-8"/>
		    <title>:: Add new Category::</title>
            <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    		<link rel="stylesheet" href="js/jquery-ui.css" rel="stylesheet">
           <script src="js/jquery-1.9.1.js"></script>
           <script src="js/jquery-ui.js"></script>
           <style>
               span{
                   color:red;
               }     
          
           </style>
<script>
function tempAlert(msg,duration)
{
 var el = document.createElement("h4");
 el.setAttribute("style","position:absolute;z-index:999;top:40%;left:40%;background-color:white;color:Gray;text-align:center;box-shadow:0px 0px 5px 1px Silver;border:5px solid Silver;padding:5px 10px;");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
}
</script>
</head>
	
<body>
	
<?php 
if(isset($_SESSION['uid']))
{
 $cerr="";
if(isset($_POST['submit'])) 
{
$catname=$_POST['catname'];
$catname=trim($catname);
$catname=chop($catname);
$con=mysqli_connect("localhost","root","root","gadget");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result=mysqli_query($con,"Select type_name from type where type_name='".$catname."'");
 
if((mysqli_num_rows($result))==1)
{
 echo "<script>tempAlert(\"Name already exists!\",2000);</script>";
}
else
{
    if(!preg_match("/^[a-zA-Z]*$/",$catname))
                    {
                     $cerr = "Only letters allowed";
                      $a="";
                    }
                    else
                    {
                    $a=1;
                    }
 if($a==1){                   
$sql="INSERT INTO type(type_name)
VALUES('$catname')";

 if (!mysqli_query($con,$sql))
  {
    die('Error: ' . mysqli_error($con));
  }
 
 echo "<script>tempAlert(\"New Category added\",2000);</script>"; 
 header('Location:addnewcategory.php');
 }
 else {
     
 }
}
 }
 else
 {
    $catname=""; 
 }
}
else
{
header('Location:login.php');
}
?>
   <script src="bootstrap/js/bootstrap.js"></script>
  	
	<div class="container">
	    <?php include_once('admin_header.html');?>
          
		
           
		   <form method="post" action="addnewcategory.php" class="form">
		   <table align="center">
		   <legend> Add New category</legend>
		
			<tr><td>Category Name:</td>
                            <td><input type="text" name="catname" required value="<?php echo $catname;?>"><span><?php echo $cerr;?></span></td></tr>
					
			<tr><td></td><td><button class="btn btn-small btn-success" style="width:100px" id="submit" type="submit" name="submit">Save</button></td></tr>			
		
		
	</table></form>
		     <hr>
			<a href="adminpage.php"><b> &lt;&lt; &nbsp; Go Back &nbsp;&lt;&lt;</br></a>
		
	</div>
       
	</body>
</html>