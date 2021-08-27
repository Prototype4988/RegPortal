<?php
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );
if(isset($_GET['userid']))
{
$sql="select Client from register where SI_no=:userid";
$stmt=$pdo->prepare($sql);

$stmt->execute(array(':userid' =>$_GET['userid']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row === false)
{
	
	header("location:view.php");
	return;
}
$name = $row['Client'];
$sql= "select COUNT(Station_name) as num from register where Client=:client";
$stmt=$pdo->prepare($sql);

$stmt->execute([':client' => $name]); 
$row2=$stmt->fetch(PDO::FETCH_ASSOC);
if($row2 === false)
{
	
	header("location:view.php");
	return;
}

$sql = "select * from register where Client=:client";
$stmt=$pdo->prepare($sql);

$stmt->execute(array(':client' =>$name));
$row1=$stmt->fetch(PDO::FETCH_ASSOC);
if($row1 === false)
{
	
	header("location:view.php");
	return;
}


}


?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/6f94d30cd9.js" crossorigin="anonymous"></script>
<head>
	<style type="text/css">
		#To
		{
			margin-left: 30px;
		}
		#Sub
		{
			margin-left: 60px;
			line-height: 40%;
		}
		.left
		{
			float: right;
			margin-right: 10px;
		}


	</style>
	<script type="text/javascript">
    function Export2Doc(element, filename = ''){
        var html = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta><title>Export HTML To Doc</title></head><body>";
        var footer = "</body></html>";
        var html = html+document.getElementById(element).innerHTML+footer;
    
        
        //link url
        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
        
        //file name
        filename = filename?filename+'.doc':'document.doc';
        
        // Creates the  download link element dynamically
        var downloadLink = document.createElement("a");
    
        document.body.appendChild(downloadLink);
        
        //Link to the file
        downloadLink.href = url;
            
        //Setting up file name
        downloadLink.download = filename;
            
        //triggering the function
        downloadLink.click();
        //Remove the a tag after donwload starts.
        document.body.removeChild(downloadLink);
    }
</script>
	<title>Report</title>
	<div id="exportContent">
	<b>Dr.Rajesh Katyal</b>
	<br>
	<b>DDG & Division Head - WSOM</b>
	<div class="left">
	<b>Ref.no NIWE/WRA/0S0/2008-2009/Vol XVI</b>
	<br>
	<?php
echo "Date:".(date("d/m/Y")."<br>");
?>
</div>
	<br>
	<br>
	<div id="To">
	<b>To</b>
	<p>Mr.<?= $row1['Client'] ?></p>
	<p><?= $row1['Station_name'] ?></p>
	<p><?= $row1['village'] ?>,<?= $row1['district'] ?>,<?= $row1['state'] ?></p>
</div>
<div id="Sub">
	<p><b>Sub:</b>Wind Monitoring Mast Registeration-Reg.</p>
	<p><b>Ref:</b>Your letter no.<?= $row1['SI_no'] ?></p>
</div>

</head>
<body>
<span>Sir,</span>
<br>
<p style="margin-left: 30px;">Received your above cited letter along with payment receipt of Demand Draft number <?= $row1['ddno'] ?> dated <?= $row1['date_receipt'] ?> for <br>an amount of Rs.<?= $row1['amount'] ?> towards the registration charges of <?= $row2['num'] ?> wind masts in <?= $row1['state'] ?> </p>
<p style="margin-left: 30px;"> I hereby inform you that the following sites in <?= $row1['state'] ?> has been registered as per MNRE guidlines vide
	No 51/9/2007-WE<br> dted 20.06.2008 with NIWE.The payment receipt will be sent to you seperately</p>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );
if(isset($_GET['userid']))
{
$sql="select Client from register where SI_no=:userid";
$stmt=$pdo->prepare($sql);

$stmt->execute(array(':userid' =>$_GET['userid']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row === false)
{
	
	header("location:view.php");
	return;
}
$name = $row['Client'];
$sql = "select * from register where Client=:client";
$stmt=$pdo->prepare($sql);

$stmt->execute(array(':client' =>$name));



}

echo '<div class="container">';
     
     	echo '<table class="table table-hover">';
     		
  	
  		echo '<thead>';
  		echo "<tr>";
  		echo "<th>";
  		echo "SI no";
  		echo "</th>";
  		echo "<th>";
  		echo "NIWE Reg NO";
  		echo "</th>";
  		echo "<th>";
  		echo "Site_Name";
  		echo "</th>";
  		echo "<th>";
  		echo "State";
  		echo "</th>";
  		echo "<th>";
  		echo "Latitude";
  		echo "</th>";
  		echo "<th>";
  		echo "Longitude";
  		echo "</th>";
  		echo "</tr>";
  		echo '</thead>';
  		while($row1=$stmt->fetch(PDO::FETCH_ASSOC) )
  	{
  		echo '<tbody id="myTable">';
  		echo "<tr><td>";
  		echo(htmlentities($row1['SI_no']));
  		echo "</td><td>";
  		echo(htmlentities($row1['NIWE_Reg_No']));
  		echo "</td><td>";
		echo(htmlentities($row1['Station_name']));
  		echo "</td><td>";
  		echo(htmlentities($row1['state']));
  		echo "</td><td>";
  		echo(htmlentities($row1['latitude']));
  		echo "</td><td>";
  		echo(htmlentities($row1['longitude']));
  		
      
  		echo "</td></tr>";
  		
  		echo '</tbody>';
	  		}
  		
  		
  		echo "</table>";
  		
    
    echo "</div>";
?>

<p>Kindly acknowledge the recipt of the same.</p>
<p>Thanking you,</p>
<div class="left">
<p>Your's Faithfully,</p>
<b>Dr.Rajesh Katyal</b>
</div>
<br>
<br>
<br>
<br>
<p><b>Copy for information:</b>The Managing director,New & Renewable Energy Development Cooperation</p>
</div>
</body>

<footer style="text-align: center;">
	<button onclick="window.print()">Print</button>
	<button onclick="Export2Doc('exportContent','report');">Export as .doc</button>
</footer>

</html>
