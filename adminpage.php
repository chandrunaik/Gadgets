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
		<title>::login/register::</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"  type="text/css"/>
		<script src="js/alertbox.js"></script>
                <link rel="stylesheet" href="css/tabletheme.css"  type="text/css"/>
		
                <!-- Data tables and J editable -->
                
                <script src="jquery_tables/js/jquery.min.js"></script>
                <script src="jquery_tables/js/jquery.jeditable.js"></script>
                <script src="jquery_tables/js/jquery.blockui.js"></script>
   
             
                <script src="js/htmltoexcel.js"></script>
                       
 <script> 
    $(document).ready(function() {
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
     
     
    });
</script>
</head>
<body>
    <div class="container">

        <?php include_once('admin_header.html');?>  

            <?php 
             if(isset($_SESSION['uid']))
              {
       $id=$_SESSION['uid'];
   $con=mysqli_connect("localhost","root","root","gadget");
   // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 
  $c=0;
  $result = mysqli_query($con,"SELECT gadget_id,gadget_type,gadget_name,model_no,sl_no,rcvd_date,status,comment from gadgetlist WHERE user_id='$id'");
 
  echo "<table class=\"table table-bordered\" id=\"testTable\">
        <legend><span id=\"tblheading\">Item Details</span></legend>
        <thead><tr><th>#</th><th>Type</th><th>Name</th><th>Model No.</th><th>Serial No.</th>
        <th>Received Date</th><th>Status</th><th>Comments</th></tr></thead></tbody>";
  
  if($result === FALSE) 
  {
    die(mysql_error()); // TODO: better error handling
  }
  
  while($row = mysqli_fetch_array($result))
    {
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
  
   }
  else
   {
    header('Location:login.php');
    exit;
   }  
?>
  <a href=addnewgadgeta.php><b>+ &nbsp;Add New &nbsp; |</b></a>
  <a href="javascript:tableToExcel('testTable', 'W3C Example Table')"><b>Save as Excel</b></a>
    </div>
  	</body>
</html>