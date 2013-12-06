<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
                <title>:: Welcome to GMS, Vidya Poshak ::</title>
                <link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<link href="css/signin.css" rel="stylesheet">
		<script src="jq/jquery-1.10.1.min.js">
		</script>
	<script type="text/javascript">
			$(document).ready(function()
			{
                            if((("#msg").html)===""){
                           $("#msg").fadeOut(5000);}
                        });
					      
	</script>	
		
		<style>
              
                body
               {
                   background-image: url('img/innerbackgrnd.png'); 
                   background-repeat:repeat;
                      
                }
                #ttl
                {
                    background: black;
                    opacity:0.8;
                    color:silver;
                    font-weight:bolder;
                    text-align: center;
                    box-shadow:0px 1px 5px 1px gray;
                    font-family: colonna MT,Times new roman;
                    padding:5px 0px;                    
                }
                #logotxt
                {
                    font-family: Harlow Solid Italic,Cambria,Times New Roman;
                    font-weight:bold;
                    color:skyblue;
                    font-size:45px;
                    text-align:center;
                    padding-top:30px;
                    text-shadow: 3px 2px black;
                                    
                }
                #vplogo
                {
                    font-family:Cambia;
                   // font-weight:bold;
                    color:greenyellow;
                    font-size:20px;
                    text-align:center;
                    opacity:0.8;
                    padding-bottom: 0px;
                    font-family: cambria,colonna MT,Times new roman;
                                
                }
                img
                {
                 box-shadow:0px 0px 5px 1px gray; 
                             
                }
                
                #msg
		{
		  color:Red;
		  font-weight:bold;
		 // border: 1px dotted black;
		  padding:5px;
		  //width:240px;
                  text-align: center;
                     
		}
		#signin
		{
                padding-left: 40px;
		text-align: left;
		}
                #wrapper
                {
                    margin-top:-50px;
                    margin-left:0px;
                    margin-right:0px;
                }
                h3
                {
                   color:White;
                   font-family: colonna MT,Times new roman;
                   font-size:25px;
                        
                }
                
                hr{
                    color: green;                
                }
                #ftext
                {
                    text-align:center;
                    color:teal;  
                    
                }
                #ftext span
                {
                  color:gray;  
                }
                #help{
                    text-align: center;
                    color:Black;
                    font-weight:bold;
                    font-family: cambria; 
                   
                }
                #help span
                {
                color:blue;    
                font-size:17px;
                }
                sup{
                    font-family:calibri;
                    font-size:30px;
                    font-weight: normal;
                }
                form
                {
                    text-align: center;
                                      
                }             
              </style>
                <script src="js/alertbox.js"></script>  
	</head>
<body>
<script src="jq/jquery-1.10.1.min.js">
</script>
		
<?php 
$err="";
if(isset($_POST['submit'])) 
{
  
 $con=mysqli_connect("localhost","root","root","gadget");
 // Check connection
if (mysqli_connect_errno())
 {
  echo "Failed to connect, please retry.";// to MySQL: " . mysqli_connect_error();
 }
 
 $email = protect($_POST['email']);
 $password = protect($_POST['password']);
 
$result = mysqli_query($con,"SELECT * FROM user WHERE email='$email' AND password='$password'");

if((mysqli_num_rows($result))==0)
  {
    $err="INVALID EMAIL/PASSWORD";
   
  }
 elseif((mysqli_num_rows($result))==1)
 {
 while($row = mysqli_fetch_array($result)) 
  {
        $uid=$row['user_id'];
		$_SESSION['uid']=$uid;
                
		$_SESSION['name']= $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
		$roles=$row['role'];
		$role=(string)$roles;
		$_SESSION['role']=$role;
		if((strcmp($role,"admin"))==0)
		{
		 header('Location:adminpage.php');
		}
		else
		{
	         header('Location:usermain.php');
		}
  }
 
 }
else
{
 echo "<script>alert(\"Sorry...Could not process\");</script>";
} 
 }

function protect($value){
 $con=mysqli_connect("localhost","root","root","gadget");
  return mysqli_real_escape_string($con,trim(strip_tags($value)));
}
/*************FUNCTION TO PROTECT USERNAME**************
  function test_input($data)
{
  $data1 = chop($data);
  $data2 = trim($data1);
  $data3 = stripslashes($data2);
  $data4 = htmlspecialchars($data3);
  return $data4;
}*/
?>
<div id="wrapper">
    <h2 id="ttl">Welcome to Vidya Poshak's Gadget Management System</h2>
    <p id="logotxt"><img alt="vplogo" src="img/vplogo.jpg"/>&nbsp;Vidya Poshak<sup>&nbsp;&reg;</sup></p>
    <p id="vplogo"> A non-profit registered society with a mission "Empowering Educational Community".</p>
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
	<h3 id="signin">LOG IN</h3>
		
        <input type="text" class="form-control" name="email" id="email" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        
        <p><button class="btn btn-success" name="submit" type="submit">Sign in</button></p>
         <p id="msg"><?php echo $err;?></p> 
      </form>
    
</div>
<h5 id="help"><i>For technical help,&nbsp;please contact:&nbsp;<span><a href="mailto:parashuram@vidyaposhak.org">parashuram@vidyaposhak.org</a></span></i></h5>
 <legend></legend>
 <footer>
     <p id="ftext"><b><span>Powered by:</span>&nbsp;<a href="http://vidyaposhak.org" target="_blank">Vidya Poshak</a>&nbsp; <span>Developed by:&nbsp;Chandrashekhar Naik (VP ID: UK-1347-10-11)</span></b></p>
    
</footer>

	</body>
</html>