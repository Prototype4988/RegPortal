<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php


session_start();
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );
if(isset($_POST['name2']) )

{
	$sql="update register 
			set Station_name = :name ,
			commision_date= :date ,
			mast_height= :mast,
			village=:vil,
			district = :dist,
			state=:state,
			Client=:client,
			amount=:amt,
			latitude=:lat,
			longitude=:long,
			date_receipt=:receipt,
			comment=:comment,
			survey_map=:survey,
			ddno=:ddno
			where SI_no= :userid";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':name' => $_POST['name2'],':date' => $_POST['date'],
  						':mast' => $_POST['mast'],':vil' => $_POST['village'],':dist' => $_POST['dist'],':state' => $_POST['state'],':client' => $_POST['owner'],':lat' => $_POST['lat1'],':long' => $_POST['long1'],':amt' => $_POST['amt'],':receipt' => $_POST['receipt'],':ddno' => $_POST['dd'],':comment' => $_POST['comment'],':survey' => $_POST['survey'],':userid' => $_GET['edit']));
  	$_SESSION['success']="Record edited";
  	header("location:view.php");
  	return;
}
$sql=" select * from register where SI_no =:mip";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(':mip' => $_GET['edit']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:view.php");
	return;
}
?>



<form method='post'>
<h2> Edit form</h2>
		<div>
			<p>Station name:<input type="text" name="name2" value= "<?= $row['Station_name'] ?>"></p>
			<p>Commissioning date:<input type="date" name="date"value= "<?= $row['commision_date'] ?>"></p>
			<p>Mast height:<input type="integer" name="mast" id="lat1" value= "<?= $row['mast_height'] ?>">meters</p>
			<p>Village/taluk name:<input type="text" name="village" value= "<?= $row['village'] ?>"></p>
			<p>District:<input type="text" name="dist" value= "<?= $row['district'] ?>"></p>
			<p>State:<input type="text" name="state" value= "<?= $row['state'] ?>"></p>
			<p>Latitude:<input type="text" name="lat1" value= "<?= $row['latitude'] ?>"></p>
			<p>Longitude:<input type="text" name="long1" value= "<?= $row['longitude'] ?>"></p>
			<p>Owned by:<input type="text" name="owner" value= "<?= $row['Client'] ?>"></p>
			<p>Amount deposited:<input type="text" name="amt" value= "<?= $row['amount'] ?>"></p>
			<p>Date of receipt:<input type="date" name="receipt" value= "<?= $row['date_receipt'] ?>"></p>
			<p>DD no and date:<input type="text" name="dd" value= "<?= $row['ddno'] ?>"></p>
			<p id="collapse" >Comments +:</p>
			<textarea id="textarea" name="comment" ></textarea>
			<br>
			<label>Survey map:</label>
			<select name="survey" id="cars">
    		<option value="Provided" name="P">Provided</option>
    		<option value="Not Provided"name="P">Not Provided</option>
    		</select>

			<p><input type="submit" name="update" value="update"></p>
			<a href="view.php">cancel</a>
</form>
</body>
</html>
