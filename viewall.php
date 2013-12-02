<?php session_start();
ob_start();
if(!(isset($_SESSION['uid'])))
{
    header('Location:Login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
	        <meta charset="utf-8"/>
		<title>:: view list ::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<script src="js/alertbox.js"></script>
		<style>
		#header
		{
		border:5px solid #C2C9C9;
		border-radius:5px;
		padding-left:100px;
		color:teal;
		font-weight:bold;
		font-size:15px;
		background:#F9FAFA;
		}
		#select
		{
		margin-top:10px;
		}
		#select option
		{
		padding:5px;		
		}
		#link
		{
		padding:5px 10px;
		//border:3px solid #999;
		border-radius:5px;
		box-shadow:0px 1px 3px 3px #999;
		}
		th
		{
		background-color:#C2C9C9;
		}
                .editable
                {
                    contenteditable:"true";
                }
		</style>
                
		</head>
		
	<?php 
              $con=mysqli_connect("localhost","root","root","gadget");
	 ?>
		
<body>
	<script src="jq/jquery-1.10.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
	<div class="container">
    
	<?php include_once('admin_header.html');?>

	<script>
function viewusers()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","viewusers.php?",true);
xmlhttp.send();
}

// view categories

function viewallbycategory(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","viewallcatwise.php?q="+str,true);
xmlhttp.send();
}

// view gadgets by user

function viewgadgetsbyuser(userid)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","viewgadgetsbyuser.php?userid="+userid,true);
xmlhttp.send();
}
</script>
		<p id="header">View by Category:
		
		<select id="select" name="gtype" onchange="viewallbycategory(this.value)">
			<?php 
			          echo "<option value=\"\">Select Category</option>";
					  echo "<option value=\"viewall\">View All Items</option>";
						 
                          $sql = mysqli_query($con,"SELECT * FROM type");
                          while ($row = mysqli_fetch_array($sql))
						  {
                          echo "<option value=\"".$row['type_name']."\">" . $row['type_name'] . "</option>";
						  }
			?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
			<a id="link" href="javascript:viewusers();">View all users</a></b></p>
			
			
			<div id="content" ></div> 

  </div>
  
	</body>
</html>