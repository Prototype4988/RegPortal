<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );
if(!empty($_GET['name2']))
{
$sql="insert into register(NIWE_Reg_No,Station_name,village,district,state,commision_date,Client,latitude,longitude,mast_height,amount,date_receipt,ddno,followup,survey_map,comment)values(:reg,:stat,:vil,:dist,:state,:comdate,:client,:lat,:long,:mast,:amt,:date,:ddno,:follow,:survey,:comment)";

$stmt=$pdo->prepare($sql);
$num = "true";
while($num != "false")
{
$mad = 'C-WET-PM-R-';
$mad1=rand(1,100);
$mad2=strval($mad1);
$mad3=$mad.$mad2;
$stmt1=$pdo->prepare("select * from register where NIWE_Reg_No=:reg1");
$stmt1->execute([':reg1' => $mad3]); 
$row4=$stmt->fetch(PDO::FETCH_ASSOC);
if($row4 === false)
{
	$num="false";
	
	
}
else
{
	$num = "true";
}


}

if(!empty($_GET['lat'])&& !empty($_GET['long']))
{
	$lat=$_GET['lat'];
	$log=$_GET['long'];
}
if(!empty($_GET['deg1'])&&!empty($_GET['min1'])&& !empty($_GET['sec1']))
{
$var1=$_GET['deg1'];
$var2=$_GET['min1'];
$var3=$_GET['sec1'];
$lat= $var1 + ($var2/60) + ($var3/3600);
}
if(!empty($_GET['deg2'])&&!empty($_GET['min2'])&& !empty($_GET['sec2']))
{
$var1=$_GET['deg2'];
$var2=$_GET['min2'];
$var3=$_GET['sec2'];
$log= $var1 + ($var2/60) + ($var3/3600);
}
if(!empty($_GET['easting'])&& !empty($_GET['norting'])&& !empty($_GET['zone']))
{




$_SESSION["x"] = $_GET['easting'];
$_SESSION["y"] = $_GET['norting'];
$_SESSION["z"] = $_GET['zone'];
include 'utm.php';

$lat=$_SESSION['latitude'];
$log=$_SESSION['longitude'];
	
	


}

 $stmt->execute(array(':reg' =>$mad3 ,':stat' =>$_GET['name2'] ,':vil'=>$_GET['village'],':dist' =>$_GET['dist'],':state' =>$_GET['state'],':comdate' =>$_GET['date'],':state' =>$_GET['state'],':client' =>$_GET['owner'],':lat' =>$lat,':long' =>$log,':mast' =>$_GET['mast'],':amt' =>$_GET['amt'],':date' =>$_GET['receipt'],':ddno' =>$_GET['dd'],':follow' =>$_GET['follow'],':survey' =>$_GET['survey'],':comment' =>$_GET['comment'] ));
}
 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>

	<style type="text/css">
		#header{
			background-image:repeating-radial-gradient(rgb(95, 95, 255),white);
    		padding: 20px 20px 20px 20px ;
    		text-align: center;

			}
		#deg1
		{
			width: 20px;
		}
		#min1
		{
			width: 20px;
		}
		#sec1
		{
			width: 20px;
		}
		#deg2
		{
			width: 20px;
		}
		#min2
		{
			width: 20px;
		}
		#sec2
		{
			width: 20px;
		}
			
		#radio
		{
			display: flex;

		}
		#lat1
		{
			border: 0;
 			outline: 0;
  			background: transparent;
  			border-bottom: 1px solid black;
		}
		#collapse
		{
			border:none;
			background-color:white;
  			color: black;
  			cursor: pointer;
  			
  			width: 4%;
  			height: 1%;
  			
  			text-align: left;
  			outline: none;
  			
		}
		#textarea
		{
			display: none;
  			overflow: hidden;
		}
		#form
		{
			border: 1px solid;
			border-color: lightblue;
			float: right;
			padding: 30px;
			margin-left: 20px;
		}

	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	 <div id ="header">
                <h1>MAST REGISTRATION PORTAL</h1>
                <h3>National Institute of Wind Energy</h3>
                <h4>(Ministry of New and Renewable Energy)</h4>
            </div>
	<div id="form">
	<form method="GET">
		<h2> Registeration form</h2>
		<div>
			<p>Station name:<input type="text" name="name2"></p>
			<fieldset style="width:60%">
			<legend><p>Coordinates:</p></legend>
			<div id="radio">
			<p>DMS<input type="radio" name="coord" value="DMS" id="dms1" onclick="dms();"></p>
			<p>&emsp;DD<input type="radio" name="coord" value="DD" id="dd" onclick="dd5();"></p>
			<p>&emsp;UTM<input type="radio" name="coord" value="UTM" id="utm" onclick="utm();"></p>
		</div>
			<div id="dms" style="display: none">
				<span>Latitude</span>
				<p>Deg<input type="integer" name="deg1" id="deg1">Min<input type="integer" name="min1" id="min1">Sec<input type="integer" name="sec1" id="sec1">
				<br>
				<br>
				<span>Longitude</span>
				<p>Deg<input type="integer" name="deg2" id="deg2">Min<input type="integer" name="min2" id="min2">Sec<input type="integer" name="sec2" id="sec2">
				
			</div>
			<div id="dd1" style="display: none">
			<p>Latitude:<input type="text" name="lat" id="lat1"><br>Longitude:<input type="text" name="long" id="lat1"></p>
		</div>
		<div id="utm1" style="display: none">
			<p>UTM Easting<input type="text" name="easting" id="easting" size="5"></p>
			<p>UTM Northing<input type="text" name="norting" id="norting" size="5"></p>
			<p>Zone<input type="integer" name="zone" id="zone" size="5">

		</div>
			
</fieldset>

			<p>Commissioning date:<input type="date" name="date"></p>
			<p>Mast height:<input type="integer" name="mast" id="lat1">meters</p>
			<p>Village/taluk name:<input type="text" name="village"></p>
			<p>District:<input type="text" name="dist"></p>
			<p>State:<input type="text" name="state"></p>
			<p>Owned by:<input type="text" name="owner"></p>
			<p>Amount deposited:<input type="text" name="amt"></p>
			<p>Date of receipt:<input type="date" name="receipt"></p>
			<p>DD no and date:<input type="text" name="dd"></p>
			<p id="collapse" onclick="display();">Comments +:</p>
			<textarea id="textarea" name="comment"></textarea>
			<p>Followup:<input type="text" name="follow">
				<br>
				<br>
			<label>Survey map:</label>
			<select name="survey" id="cars">
    		<option value="Provided" name="P">Provided</option>
    		<option value="Not Provided"name="P">Not Provided</option>
    		</select>
		</div>
			<p><input type="Submit" name="submit"></p>

	</form>
	<script type="text/javascript">

		function display()
		{
			textarea.style.display="block";
		}

		 $(function () {
        $("input[name='coord']").click(function () {
            if ($("#dms1").is(":checked")) {
                $("#dms").show();
            } else {
                $("#dms").hide();
            }

            if ($("#dd").is(":checked")) {
                $("#dd1").show();
            } else {
                $("#dd1").hide();
            }


            if ($("#utm").is(":checked")) {
                $("#utm1").show();
            } else {
                $("#utm1").hide();
            }
        });
    });
		
	</script>

</body>
<footer style="text-align: center;">
	<a style="text-decoration: none;" href="#">Back&emsp;&emsp;</a>
	<a href="#" style="text-decoration: none;">Next</a>
</footer>
</div>
</html>
