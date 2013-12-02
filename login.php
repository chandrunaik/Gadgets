<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
                <meta title="GMS Vidya poshak" content="gms system vidyaposhak"/>
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
		  border-bottom:2px solid teal;
		  padding:0px 0px;
		  width:240px;
                  text-align: center;
                  margin-left: auto;
                  margin-right: auto;
		}
                body
                {
                background-image: url('img/body.jpg');
                background-size: cover;
                margin:0px;
               // height:100%;
             // border:2px solid green;          
                }
                #wrapper
                {
                    margin-top:-50px;
                    margin-left:-5px;
                       margin-right:-10px;
                }
                h3
                {
                   color:White;
                   font-family: colonna MT,Times new roman;
                   font-size:25px;
                        
                }
                #logotxt
                {
                    font-family: Harlow Solid Italic,Cambria,Times New Roman;
                    font-weight:bold;
                    color:skyblue;
                    font-size:50px;
                    text-align:center;
                    padding-top:30px;
                    text-shadow: 2px 2px black;
                                    
                }
                #vplogo
                {
                    font-family:Cambia;
                   // font-weight:bold;
                    color:black;
                    font-size:20px;
                    text-align:center;
                    opacity:0.8;
                    padding-bottom: 0px;
                    font-family: cambria,colonna MT,Times new roman;
                    text-shadow: 2px 0px silver;
                }
                img
                {
                 box-shadow:0px 0px 0px 2px skyblue; 
                 opacity:1; 
                 border-radius:5px;
                }
                #ttl
                {
                    background:black;
                    opacity:0.8;
                    color:white;
                    font-weight:bolder;
                    text-align: center;
                    border-radius: 5px;
                    box-shadow:0px 1px 5px 1px silver;
                    font-family: colonna MT,Times new roman;
                    padding:5px 0px;                    
                }
                hr{
                    color: green;                
                }
                #ftext
                {
                    text-align:center;
                    color:teal;                                      
                }
                #help{
                    text-align: center;
                    color:Black;
                    font-weight:bold;
                    font-family: cambria; 
                    letter-spacing:initial;
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
               b#powerf
               {
               font-family: Harlow Solid Italic,Cambria,Times New Roman;
               font-size:20px; 
               color:skyblue;
                text-shadow: 1px 1px black;
               }
               #supf
               {
                  font-size:15px;
                  
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
 $email = test_input($_POST['email']);
 $password = test_input($_POST['password']);
 
 $con=mysqli_connect("localhost","root","root","gadget");

 // Check connection
if (mysqli_connect_errno())
 {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
$result = mysqli_query($con,"SELECT * FROM user WHERE email='$email' AND password='$password'");

if((mysqli_num_rows($result))==0)
  {
    $err="Invalid email or password";
   
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
  function test_input($data)
{
  $data = chop($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div id="wrapper">
    <h2 id="ttl">Welcome to Vidya Poshak's Gadget Management System</h2>
    <p id="logotxt"><img alt="vplogo" src="img/vplogo.jpg"/>&nbsp;Vidya Poshak<sup>&nbsp;&reg;</sup></p>
    <p id="vplogo"> A non-profit registered society with a mission "Empowering Educational Community".</p>
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
	<h3 id="signin">PLEASE SIGN IN</h3>
		
        <input type="text" class="form-control" name="email" id="email" placeholder="Email address" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        
        <p><button class="btn btn-success" name="submit" type="submit">Sign in</button></p>
         <p id="msg"><?php echo $err;?></p> 
      </form>
    
</div>
<h5 id="help"><i>For technical help,&nbsp;please contact:&nbsp;<span><a href="mailto:parashuram@vidyaposhak.org">parashuram@vidyaposhak.org</a></span></i></h5>
<footer>
   <hr> 
   <p id="ftext"><B>&copy;&nbsp;Vidya Poshak 2013.</B>&nbsp;powered by <b id="powerf">Vidya Poshak &nbsp;<sup id="supf">&reg</sup></b>  Designed by:&nbsp;<b>Chandrashekhar Naik (VP ID: UK-1347/2010-11)</b></p>
    
</footer>

	</body>
</html>