

<?php


session_start();
$pdo = new PDO("mysql:host=localhost;dbname=niwe;port=3306",'root','root' );


if(isset($_POST['delete']) && (isset($_POST['userid'])))

{
	$sql="delete from register where SI_no= :zip";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute([':zip' => $_POST['userid']]);
  	$_SESSION['success']="Record deleted";
  	header("location:view.php");
  	return;
}



$sql=" select * from register where SI_no =:mip";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(':mip' => $_GET['userid']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if($row === false)
{
	$_SESSION['error']="Bad value  deleting";
	header("location:view.php");
	return;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p> Confirm deleting <?= htmlentities($row['Station_name'])?></p>

<form method='post'>
<input type='hidden' name='userid' value='<?= $row['SI_no'] ?>'>
<input type="submit" name="delete" value="delete">
<a href="view.php">cancel</a>
</form>
</body>
</html>














