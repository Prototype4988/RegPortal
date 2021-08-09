<?php
session_start();
$x=$_SESSION["x"];//value of x
$y=$_SESSION["y"];//value of x
$zone=$_SESSION["z"];//value of Zone
$jsondata= utm2ll($x,$y,$zone,true); 
$response=json_decode($jsondata, true);
$lat= $response['attr']['lat'];
$log= $response['attr']['lon'];

$_SESSION['latitude']=$lat;
$_SESSION['longitude']=$log;


// Funtions 
   function utm2ll($x,$y,$zone,$aboveEquator){
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
	
?>
