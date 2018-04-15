<?php
session_start();
ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=login.html", true, 303);
 }

?>

<!DOCTYPE html>

<head>

	
	
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
	
	<style> 
	body {
  background-color: #8baee5;
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}
div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}
.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}
.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}
th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}
tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}
tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:35px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}
td:last-child {
  border-right: 0px;
}
th.text-left {
  text-align: left;
}
th.text-center {
  text-align: center;
}
th.text-right {
  text-align: right;
}
td.text-left {
  text-align: left;
}
td.text-center {
  text-align: center;
}
td.text-right {
  text-align: right;
}
	
.headertest
    {
    text-align:center;
    width:100%;
    }


body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.topnav {
  overflow: hidden;
  background-color: 	#808080;
  
  }
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 4px 6px;
  text-decoration: none;
  font-size: 17px;
 
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
.dropdown-item{
	padding:20px;
    background-color: blue;
  }
  
  form.ws-validate{
  	float:left;
	padding-left: 10px;
    display: inline-flex;
  }
  
  .form-row.show-inputbtns {
  	margin-right: 5px;
  }
  
  button.btn.btn-primary{
  	margin-left: 440px;
  }


</style>
 
</head>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<!-- https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js -->
<script type = "text/javascript"  >


$(document).ready(function(){
  $("#A").click(function(){

        var s = $("#zip").val();
        var o = $("#special").val();    
            $.ajax ({ 
            	  
            		type: "GET",
            		url: "location.php",
            		data: "u=" +o +"&uu="+s ,        		
            	               
            		error: function(xhr, status, error) {alert( "error Message: \r\nNumeric code is: " + xhr.status + " \r\nError is " + error );},
            		success: function(result){
		var parsed_result = JSON.parse(result);
	
		var id_prefx= ['a','b','c','d','e'];
		var element;
	for(var i =0; i < id_prefx.length; i++)
	{
	   for(var j = 0; element = document.getElementById(id_prefx[i] + j);j++)
		{      
			if(i == 1)
			{
			  $(element).html('<img src ="' + parsed_result[i][j] + '">');
			}
			else if(i == 4)
			{ 
			   if(parsed_result[i][j] == "")
			   {
			     continue;
			   }
			   else
			    $(element).html('<a href="' + parsed_result[i][j] + '">Purchase tickets</a>');
			}
			else
			{
			$(element).html(parsed_result[i][j]);
			}
		}

	}	
		
                       }, 
     
       });

var p_titles = JSON.parse(titles);
var p_pics = JSON.parse(pics);
var p_releaseDates = JSON.parse(releaseDates);
var p_genres = JSON.parse(genres);
var p_purchLinks = JSON.parse(purchLinks);

var element; 
var prefix = 'e';

for(var i =0; element = document.getElementById(prefix +i)  ; i++)
{


        $(element).html('<a href="' + p_purchLinks[i] + '">Purchase tickets</a>');
}


var prefix = 'b';

for(var i =0; element = document.getElementById(prefix +i); i++)
{

        $(element).html('<img src ="' + p_pics[i] + '">');
}

var els = ['a','c','d'];
var lis = [p_titles, p_genres, p_releaseDates];
for (var j = 0; j < els.length; j++)
{
        for (var k =0; element = document.getElementById(els[j] + k); k++)
        {
                $(element).html(lis[j][k]);
        }
}

function hi()
{
var re = '<a href="' + p_purchLinks[0] + '">Check out this hot local movie in your area ;)</a>';
 $("#q").html(re);
 $("#qq").html("1");
var a = document.getElementById("q");
a.href = p_purchLinks[0];
}
setTimeout(hi, 7000);


     });
});     
     </script>
    
     <body>
<?php ?>


<div class="topnav">
<form action="" class="ws-validate">
     
    <div class="form-row show-inputbtns" >
        <input type="date"  id="special" name="u" data-date-inline-picker="false" data-date-popover='{
	"inline": true
}' />
    </div>
    <div class="form-rows">
    </div>
</form>

 <input type =text name="uu" id = "zip" placeholder = "Zipcode" >
     <button type=button id = "A"> Click for results </button>



</div>

<form  action="logout.php">
<input type="submit" value="Logout"> 
</form>
    
    
     
        <div class="container" style="margin-top: 20px;">

  <div class="dropdown">
    <button type="button" class="btn btn-primary" data-toggle="dropdown">
      <i class="fa fa-bell" aria-hidden="true"></i>
    </button>
   <span class="badge badge-danger" id ="qq" style="border-radius: 50%; position:relative;
   top: -18px; left: -15px;"></span>
    <div class="dropdown-menu">
      <a class="dropdown-item" id="q">No new notifications </a>
    </div>
  </div>
</div>

 
     <div id = "B" > </div>
     
<title>Movie Listing</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="css/demo.css"/>
    <link rel="stylesheet" href="css/theme1.css"/>
  </head>
  <body>
    <div id="caleandar">

    </div>

    <script type="text/javascript" src="js/caleandar.js"></script>
    <script type="text/javascript" src="js/demo.js"></script>
  </body>


<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="css/demo.css"/>
    <link rel="stylesheet" href="css/theme1.css"/>
  </head>
  
    <div id="caleandar">

    </div>

    <script type="text/javascript" src="js/caleandar.js"></script> 
    <script type="text/javascript" src="js/demo.js">
	
	</script>



     
     <div class="table-title">
<h3 class="headertest">Movie Listing</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Movie</th>
<th class="text-left">Photo</th> 
<th class="text-left">Release date</th> 
<th class="text-left">Genre</th> 
<th class="text-left">Purchase Link</th>
</tr>
</thead>
<tbody class="table-hover">
<tr>
<td class="text-left" id = "a0"></td>
<td class="text-left" id = "b0"></td> 
<td class="text-left" id = "c0"></td>
<td class="text-left" id = "d0"></td> 
<td class="text-left" id = "e0"></td>
</tr>
<tr>
<td class="text-left" id = "a1"></td>
<td class="text-left" id = "b1"></td> 
<td class="text-left" id = "c1"></td> 
<td class="text-left" id = "d1"></td> 
<td class="text-left" id = "e1"></td>
</tr>
<tr>
<td class="text-left" id = "a2"></td>
<td class="text-left" id = "b2"></td> 
<td class="text-left" id = "c2"></td> 
<td class="text-left" id = "d2"></td> 
<td class="text-left" id = "e2"></td>
</tr>
<tr>
<td class="text-left" id = "a3"></td>
<td class="text-left" id = "b3"></td> 
<td class="text-left" id = "c3"></td> 
<td class="text-left" id = "d3"></td> 
<td class="text-left" id = "e3"></td> 
</tr>
<tr>
<td class="text-left" id = "a4"></td>
<td class="text-left" id = "b4"></td> 
<td class="text-left" id = "c4"></td> 
<td class="text-left" id = "d4"></td> 
<td class="text-left" id = "e4"></td>
</tr>
</tbody>
</table>
    
</body>



