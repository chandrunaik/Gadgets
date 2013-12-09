<?php session_start();
ob_start();
$role=$_SESSION['role'];
if((strcmp($role,"admin"))==1)
{
    //header('Location:login.php');
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
		<title>:: view list ::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<link rel="stylesheet" href="css/tablecss.css" type="text/css"/>
                 <link rel="stylesheet" href="css/tabletheme.css"  type="text/css"/>
		
                <script src="js/alertbox.js"></script>                
                <script src="js/htmltoexcel.js"></script>
                <script src="jq/jquery-1.10.1.min.js"></script>
                <script src="js/htmltoexcel.js"></script>
                <script src="jquery_tables/js/jquery.jeditable.js"></script>
               
<script> 
    $.calleditable = function() {
        $('.gt').editable('http://localhost/Gadgets/update.php', {
         loadurl:'http://localhost/Gadgets/gettype.php',
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         type:'select',
         submit:'OK',
         //cancel:'cancel',
         style:'display:inline',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
         }
         });
         $('.gname').editable('http://localhost/Gadgets/update.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
         }
        });
     
        $('.gmodel').editable('http://localhost/Gadgets/update.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
          submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
         }
         });
         $('.gsl').editable('http://localhost/Gadgets/update.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
          submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
        }
       });
       $('.grd').editable('http://localhost/Gadgets/update.php', {
       indicator : '<img src="img/indicator.gif">',
       tooltip:'Click to edit',
       width:'100px',
       height:'20px',
        submit:'OK',
       //type:'date',
       callback : function(value, settings) {
      console.log(this);
      console.log(value);
      console.log(settings);
      }
     });
    // $('.gst').editable('http://localhost/Gadgets/update.php', {
       //  indicator : '<img src="img/indicator.gif">',
       //  tooltip:'Click to edit',
       //  width:'100px',
        // height:'20px',
        // callback : function(value, settings) {
        // console.log(this);
        // console.log(value);
        // console.log(settings);
      // }
     //});
     
      $('.gcomm').editable('http://localhost/Gadgets/update.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
          //width:'100px',
         //height:'20px',
         type:'textarea',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
       }); 
    };
 
   $.calluserinfoedit = function() {
  /* $('.fname').editable('http://localhost/Gadgets/updateuserinfo.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });*/
        $('.doj').editable('http://localhost/Gadgets/updateuserinfo.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });
     $('.desg').editable('http://localhost/Gadgets/updateuserinfo.php', {
         
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });
     
      $('.mobile').editable('http://localhost/Gadgets/updateuserinfo.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
          submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });
      $('.office').editable('http://localhost/Gadgets/updateuserinfo.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
         width:'100px',
         height:'20px',
          submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });
      $('.email').editable('http://localhost/Gadgets/updateuserinfo.php', {
       indicator : '<img src="img/indicator.gif">',
       tooltip:'Click to edit',
       width:'100px',
       height:'20px',
        submit:'OK',
       //type:'date',
       callback : function(value, settings) {
      console.log(this);
      console.log(value);
      console.log(settings);
      }
     });
   
    /*  $('.gcomm').editable('http://localhost/Gadgets/update.php', {
         indicator : '<img src="img/indicator.gif">',
         tooltip:'Click to edit',
          //width:'100px',
         //height:'20px',
         type:'textarea',
         submit:'OK',
         callback : function(value, settings) {
         console.log(this);
         console.log(value);
         console.log(settings);
       }
     });
     
     */
    };

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
     $.calluserinfoedit();
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
     $.calleditable();
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
     $.calleditable();
    }
  }
xmlhttp.open("GET","viewgadgetsbyuser.php?userid="+userid,true);
xmlhttp.send();
}
</script> 
     </head>
<body>
	<div class="container">
    
	<?php include_once('admin_header.html');?>
       
        <?php $con=mysqli_connect("localhost","root","root","gadget");?>
                        
    
    
	        <?php include_once('admin_header.html');?>
 
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
		
		<div id="content"></div> 

                <a href="javascript:tableToExcel('testTable', 'W3C Example Table')"><b>Save as Excel</b></a>
      
   </div> 
</body>
</html>