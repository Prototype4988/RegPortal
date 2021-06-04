<?php
$pdo = new PDO("mysql:host=localhost;dbname=niwe;port=3306",'root','root' );
if(isset($_POST['password']) && (isset($_POST['username'])))
{
	$sql="update users
			set password = :password
			where username= :username";
  	if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $_POST['username'];
            $param_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.tblLogin {
	border: #95bee6 1px solid;
    background: #d1e8ff;
    border-radius: 4px;
    max-width: 300px;
	padding:20px 30px 30px;
	text-align:center;
	margin: auto;
}
.btnSubmit {
	padding: 10px 20px;
    background: #2c7ac5;
    border: #d1e8ff 1px solid;
    color: #FFF;
	border-radius:4px;
}
.login-input {
	border: #CCC 1px solid;
    padding: 10px 20px;
	border-radius:4px;
}
.tableheader { font-size: 20px; }
	</style>
</head>
<body>
	<form method="post">
	<div class="tblLogin">
	<div class="tableheader">Enter new Password</div>
	
		<div class="tablerow"><input type="password" name="password" placeholder="new Pass" class="login-input" required></div>
		<div class="tableheader">Enter Username</div>
		<div class="tablerow"><input type="text" name="username" placeholder="Username" class="login-input" required></div>
		<div class="tableheader"><input type="submit" name="submit_email" value="Submit" class="btnSubmit"></div>
	</div>
</form>
</body>
</html>