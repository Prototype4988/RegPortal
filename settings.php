<?php
$pdo = new PDO("mysql:host=localhost;dbname=niwe;port=3306",'root','root' );
if(isset($_POST['name']) && isset($_POST['newname'])&& isset($_POST['pass']))
{
	$stmt = $pdo->prepare("select DECODE(Password,'secret') as pass from login where Username=:name;");
	$stmt->execute([':name' => $_POST['name']]); 
	$user = $stmt->fetch();
	$var1 = $user['pass'];
	if($user === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:view.php");
	return;
}

	$stmt = $pdo->prepare("select * from login where Username=:name;");
	$stmt->execute([':name' => $_POST['name']]); 
	$row = $stmt->fetch();
	$var2 = $row['Username'];
	if($row === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:view.php");
	return;
}

	if(strcmp($_POST['pass'],$var1)== 0  &&  strcmp($_POST['name'], $var2) == 0)
	{
		$sql="update login 
			set Username = :name 
			
			where Username= :name1";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':name' => $_POST['newname'],
  						':name1' => $_POST['name']));
  	$_SESSION['success']="Record edited";
  	header("location:home.html");
  	return;
	}

}


if(isset($_POST['pass1']) && isset($_POST['pass2'])&& isset($_POST['name2']))
{
	$stmt = $pdo->prepare("select DECODE(Password,'secret') as pass from login where Username=:name;");
	$stmt->execute([':name' => $_POST['name2']]); 
	$user = $stmt->fetch();
	$var3 = $user['pass'];
	if($user === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:home.html");
	return;
}

	$stmt = $pdo->prepare("select * from login where Username=:name;");
	$stmt->execute([':name' => $_POST['name2']]); 
	$row = $stmt->fetch();
	$var4 = $row['Username'];
	if($row === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:home.html");
	return;
}

	if(strcmp($_POST['pass1'],$var3)== 0  &&  strcmp($_POST['name2'], $var4) == 0)
	{
		$sql="update login 
			set Password = ENCODE(:password,'secret')
			where Username= :name1";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':password' => $_POST['pass2'],
  						':name1' => $_POST['name2']));
  	$_SESSION['success']="Record edited";
  	header("location:home.html");
  	return;
	}

}
if(isset($_POST['name3']) &&  isset($_POST['pass3']))
  {
  	$sql="insert into login(Username,Password)values(:name,ENCODE(:pass,'secret'))";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':name' =>$_POST['name3'] ,':pass' =>$_POST['pass3'] ));
  	$_SESSION['success']="Record edited";
  	header("location:home.html");
  	return;

  }


?>


<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		#header{
			background-image:repeating-radial-gradient(rgb(95, 95, 255),white);
    		padding: 20px 20px 20px 20px ;
    		text-align: center;

			}
			
			
			#name1
			{
				display: none;
				overflow: hidden;
			}
			#add
			{
				display: none;
				overflow: hidden;
			}
		</style>
	</head>
<body>
	<div class="container">
	<div id ="header">
                <h1>MAST REGISTRATION PORTAL</h1>
                <h3>National Institute of Wind Energy</h3>
                <h4>(Ministry of New and Renewable Energy)</h4>
            </div>
     <br>
    <div class="btn-group btn-group-justified">
    <div class="btn-group">
    	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Change Username or Password <span class="caret"></span></button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="name1();">Username</a></li>
        <li><a href="#" onclick="pass();">Password</a></li>
      </ul>
      
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-primary" onclick="add();">Add Recepients</button>
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-primary">Later</button>
    </div>
  </div>
  <form method="post">
  <div class="jumbotron" id="name1">
  	<p>Enter old Username<input type="text" name="name"></p>
  	<p>Enter new Username<input type="text" name="newname"></p>
  	<p>Enter your Password<input type="password" name="pass"></p>
  	<input type="submit" name="submit" value="submit">
  	</form>

  </div>
  <form method="post">
  <div class="jumbotron" id="pass">
  	<p>Enter old Password<input type="Password" name="pass1"></p>
  	<p>Enter new Password<input type="Password" name="pass2"></p>
  	<p>Enter your Username<input type="text" name="name2"></p>
  	<input type="submit" name="submit" value="submit">
  	</form>
  </div>
   <form method="post">
  <div class="jumbotron" id="add">
  	<p>Enter Username<input type="text" name="name3"></p>
  	<p>Enter Password<input type="Password" name="pass3"></p>
  	
  	<input type="submit" name="submit" value="Add">
  	</form>
  </div>
  </div>
  <script type="text/javascript">
  	function name1()
  	{
  			document.getElementById("add").style.display = "none";
  			document.getElementById("pass").style.display = "none";
  			document.getElementById("name1").style.display = "block";
  		
  	}
  	function pass()
  	{
  		document.getElementById("pass").style.display = "block";
			document.getElementById("name1").style.display = "none";
			document.getElementById("add").style.display = "none";
  	}
  	function add()
  	{
  		document.getElementById("pass").style.display = "none";
  			document.getElementById("name1").style.display = "none";
  			document.getElementById("add").style.display = "block";
  			
  	}
  	
  </script>
</body>
</html>
           