<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==1)
{
   // header('Location:login.php');
    ob_end_flush();
    exit();   
}
elseif(!(isset($_SESSION['uid'])))
{
    header('Location:login.php');
    ob_end_flush();
    exit();
}?>
<!DOCTYPE html>
<html>

	<head>
	    <meta charset="utf-8"/>
            <title>:: Add new Category::</title>
            <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
            <link rel="stylesheet" href="js/jquery-ui.css"/>
            <script src="js/jquery-1.9.1.js"></script>
            <script src="js/jquery-ui.js"></script>
            <script src="js/alertbox.js" type="text/javascript"></script>
            <style>
                     span{
                         color:red;
                        }
                    body{
                        background-image: url('img/innerbackgrnd.png'); 
                        background-repeat:repeat;
                    }
                    legend 
                    {
                        color:white;
                    }
                    .name
                    {
                         color:white;
                         //font-weight: bold;
                         padding-bottom:10px;
                         font-family:Verdana;
                     }
                    .container
                    {
                        width:80%;
                    }
          
           </style>
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
  echo "<script>setTimeout(\"location.href = 'addnewcategory.php';\",1500);</script>";
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
$sql="INSERT INTO type(type_name) VALUES('$catname')";

 if (!mysqli_query($con,$sql))
  {
    die('Error: ' . mysqli_error($con));
  }
 echo "<script>tempAlert(\"Added successfully\",2000);</script>";
  echo "<script>setTimeout(\"location.href = 'addnewcategory.php';\",1500);</script>";
 }
 else 
{}
}
}
 else
 {
    $catname=""; 
 }}
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
                         <br>
			    <tr><td class='name'>Category Name:</td>
                            <td><input type="text" name="catname" required value="<?php echo $catname;?>"><span><?php echo $cerr;?></span></td></tr>
					
                        <tr><td></td><td><button class="btn btn-small btn-success" style="width:100px" id="submit" type="submit" name="submit"><b>Save</b></button></td></tr>			
			
	           </table>
                   </form>
            <legend></legend>
			<a href="adminpage.php"><b>Go Back</b></a>
		
	</div>
       
	</body>
</html>