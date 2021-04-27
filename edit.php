<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php


session_start();
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','' );
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
			date_receipt=:receipt,
			ddno=:ddno
			where SI_no= :userid";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':name' => $_POST['name2'],':date' => $_POST['date'],
  						':mast' => $_POST['mast'],':vil' => $_POST['village'],':dist' => $_POST['dist'],':state' => $_POST['state'],':client' => $_POST['owner'],':amt' => $_POST['amt'],':receipt' => $_POST['receipt'],':ddno' => $_POST['dd'],':userid' => $_GET['edit']));
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
			<p>Owned by:<input type="text" name="owner" value= "<?= $row['Client'] ?>"></p>
			<p>Amount deposited:<input type="text" name="amt" value= "<?= $row['amount'] ?>"></p>
			<p>Date of receipt:<input type="date" name="receipt" value= "<?= $row['date_receipt'] ?>"></p>
			<p>DD no and date:<input type="text" name="dd" value= "<?= $row['ddno'] ?>"></p>
			<p><input type="submit" name="update" value="update"></p>
			<a href="view.php">cancel</a>
</form>
</body>
</html>
