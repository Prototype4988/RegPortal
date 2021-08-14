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








   function utm2l($x,$y,$zone,$aboveEquator){
		if(!is_numeric($x) or !is_numeric($y) or !is_numeric($zone)){
			return json_encode(array('success'=>false,'msg'=>"Wrong input parameters"));
		}
		$southhemi = false;
		if($aboveEquator!=true){
			$southhemi = true;
		}
		$latlon = UTMXYToLatLon ($x, $y, $zone, $southhemi);
		return json_encode(array('success'=>true,'attr'=>array('lat'=>radian2degree($latlon[0]),'lon'=>radian2degree($latlon[1]))));
	}
	

	function radian2degree($rad){
		$pi = 3.14159265358979;	
        	return ($rad / $pi * 180.0);
	}

	function degree2radian($deg){
		$pi = 3.14159265358979;
		return ($deg/180.0*$pi);
	}

	function UTMCentralMeridian($zone){
		$cmeridian = degree2radian(-183.0 + ($zone * 6.0));
		return $cmeridian;
	}
	function LatLonToUTMXY ($lat, $lon, $zone){
	        $xy = MapLatLonToXY ($lat, $lon, UTMCentralMeridian($zone));
		/* Adjust easting and northing for UTM system. */
		$UTMScaleFactor = 0.9996;
	        $xy[0] = $xy[0] * $UTMScaleFactor + 500000.0;
	        $xy[1] = $xy[1] * $UTMScaleFactor;
	        if ($xy[1] < 0.0)
        	    $xy[1] = $xy[1] + 10000000.0;
	        return $xy;
	}
	function UTMXYToLatLon ($x, $y, $zone, $southhemi){
		$latlon = array();
		$UTMScaleFactor = 0.9996;
        	$x -= 500000.0;
	        $x /= $UTMScaleFactor;
        	/* If in southern hemisphere, adjust y accordingly. */
	        if ($southhemi)
        		$y -= 10000000.0;
        	$y /= $UTMScaleFactor;
	        $cmeridian = UTMCentralMeridian ($zone);
        	$latlon = MapXYToLatLon ($x, $y, $cmeridian);	
        	return $latlon;
	}
   function MapXYToLatLon ($x, $y, $lambda0){
		$philambda = array();
		$sm_b = 6356752.314;
		$sm_a = 6378137.0;
		$UTMScaleFactor = 0.9996;
		$sm_EccSquared = .00669437999013;
	        $phif = FootpointLatitude ($y);
	        $ep2 = (pow ($sm_a, 2.0) - pow ($sm_b, 2.0)) / pow ($sm_b, 2.0);
	        $cf = cos ($phif);
	        $nuf2 = $ep2 * pow ($cf, 2.0);
	        $Nf = pow ($sm_a, 2.0) / ($sm_b * sqrt (1 + $nuf2));
        	$Nfpow = $Nf;
	        $tf = tan ($phif);
	        $tf2 = $tf * $tf;
	        $tf4 = $tf2 * $tf2;
        	$x1frac = 1.0 / ($Nfpow * $cf);
	        $Nfpow *= $Nf;   
        	$x2frac = $tf / (2.0 * $Nfpow);
	        $Nfpow *= $Nf;   
        	$x3frac = 1.0 / (6.0 * $Nfpow * $cf);
	        $Nfpow *= $Nf;   
        	$x4frac = $tf / (24.0 * $Nfpow);
	        $Nfpow *= $Nf;   
        	$x5frac = 1.0 / (120.0 * $Nfpow * $cf);
	        $Nfpow *= $Nf;   
	        $x6frac = $tf / (720.0 * $Nfpow);
        	$Nfpow *= $Nf;   
	        $x7frac = 1.0 / (5040.0 * $Nfpow * $cf);
        	$Nfpow *= $Nf;   
	        $x8frac = $tf / (40320.0 * $Nfpow);
        	$x2poly = -1.0 - $nuf2;
	        $x3poly = -1.0 - 2 * $tf2 - $nuf2;
        	$x4poly = 5.0 + 3.0 * $tf2 + 6.0 * $nuf2 - 6.0 * $tf2 * $nuf2- 3.0 * ($nuf2 *$nuf2) - 9.0 * $tf2 * ($nuf2 * $nuf2);
	        $x5poly = 5.0 + 28.0 * $tf2 + 24.0 * $tf4 + 6.0 * $nuf2 + 8.0 * $tf2 * $nuf2;
	        $x6poly = -61.0 - 90.0 * $tf2 - 45.0 * $tf4 - 107.0 * $nuf2	+ 162.0 * $tf2 * $nuf2;
	        $x7poly = -61.0 - 662.0 * $tf2 - 1320.0 * $tf4 - 720.0 * ($tf4 * $tf2);
	        $x8poly = 1385.0 + 3633.0 * $tf2 + 4095.0 * $tf4 + 1575 * ($tf4 * $tf2);
        	$philambda[0] = $phif + $x2frac * $x2poly * ($x * $x)
        		+ $x4frac * $x4poly * pow ($x, 4.0)
	        	+ $x6frac * $x6poly * pow ($x, 6.0)
        		+ $x8frac * $x8poly * pow ($x, 8.0);
        	
	        $philambda[1] = $lambda0 + $x1frac * $x
        		+ $x3frac * $x3poly * pow ($x, 3.0)
        		+ $x5frac * $x5poly * pow ($x, 5.0)
	        	+ $x7frac * $x7poly * pow ($x, 7.0);
        	
        	return $philambda;
	}

	function FootpointLatitude ($y){
		$sm_b = 6356752.314;
		$sm_a = 6378137.0;
		$UTMScaleFactor = 0.9996;
		$sm_EccSquared = .00669437999013;
	        $n = ($sm_a - $sm_b) / ($sm_a + $sm_b);
        	$alpha_ = (($sm_a + $sm_b) / 2.0)* (1 + (pow ($n, 2.0) / 4) + (pow ($n, 4.0) / 64));
	        $y_ = $y / $alpha_;
        	$beta_ = (3.0 * $n / 2.0) + (-27.0 * pow ($n, 3.0) / 32.0)+ (269.0 * pow ($n, 5.0) / 512.0);
	        $gamma_ = (21.0 * pow ($n, 2.0) / 16.0)+ (-55.0 * pow ($n, 4.0) / 32.0);
	        $delta_ = (151.0 * pow ($n, 3.0) / 96.0)+ (-417.0 * pow ($n, 5.0) / 128.0);
        	$epsilon_ = (1097.0 * pow ($n, 4.0) / 512.0);
	        $result = $y_ + ($beta_ * sin (2.0 * $y_))
        	    + ($gamma_ * sin (4.0 * $y_))
	            + ($delta_ * sin (6.0 * $y_))
	            + ($epsilon_ * sin (8.0 * $y_));
        	return $result;
	}
	
	$x=$_SESSION["x"];//value of x
$y=$_SESSION["y"];//value of x
$zone=$_SESSION["z"];//value of Zone

$jsondata= utm2l($x,$y,$zone,true); 
$response=json_decode($jsondata, true);
$lat= $response['attr']['lat'];
$log= $response['attr']['lon'];
	
	


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
