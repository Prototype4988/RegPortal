<?php
$pdo = new PDO("mysql:host=localhost;dbname=niwe;port=3306",'root','root' );

$username = $password = $confirm_password =$email= "";
$username_err = $password_err  =$email_err= "";
if(isset($_POST['name']) && isset($_POST['newname'])&& isset($_POST['pass']))
{

	$stmt = $pdo->prepare("SELECT  password FROM users WHERE username = :username;");
	$stmt->execute([':username' => $_POST['name']]); 
	$user = $stmt->fetch();
	$var1 = $user['password'];
	if($user === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:view.php");
	return;
}

	$stmt = $pdo->prepare("select * from users where username=:name;");
	$stmt->execute([':name' => $_POST['name']]); 
	$row = $stmt->fetch();
	$var2 = $row['username'];
	if($row === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:view.php");
	return;
}

	if(password_verify($_POST['pass'], $var1)  &&  strcmp($_POST['name'], $var2) == 0)
	{
		$sql="update users 
			set username = :name 
			
			where username= :name1";
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
	$stmt = $pdo->prepare("SELECT  password FROM users WHERE username = :username;");
	$stmt->execute([':username' => $_POST['name2']]); 
	$user = $stmt->fetch();
	$var3 = $user['password'];
	if($user === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:home.html");
	return;
}

	$stmt = $pdo->prepare("select * from users where username=:name;");
	$stmt->execute([':name' => $_POST['name2']]); 
	$row = $stmt->fetch();
	$var4 = $row['username'];
	if($row === false)
{
	$_SESSION['error']="Bad value  editing";
	header("location:home.html");
	return;
}

	if(password_verify($_POST['pass1'], $var3)  &&  strcmp($_POST['name2'], $var4) == 0)
	{
		$sql="update users 
			set password = password_hash(:password, PASSWORD_DEFAULT);
			where username= :name1";
  	$stmt=$pdo->prepare($sql);
  	$stmt->execute(array(':password' => $_POST['pass2'],
  						':name1' => $_POST['name2']));
  	$_SESSION['success']="Record edited";
  	header("location:home.html");
  	return;
	}

}
if(isset($_POST['name3']) &&  isset($_POST['pass3']) && isset($_POST['email']))
  {
  	$username = $password = $confirm_password =$email= "";
$username_err = $password_err = $confirm_password_err =$email_err= "";
 
// Processing form data when form is submitted

 
    // Validate username
  if(empty(trim($_POST["name3"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            $param_username = trim($_POST["name3"]);
            
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["name3"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        $sql = "SELECT id FROM users WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
                
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            $param_email = trim($_POST["email"]);
            
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["pass3"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pass3"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["pass3"]);
    }
    
    // Validate confirm password
    
    
    // Check input errors before inserting in database
    if(empty($username_err)&& empty($email_err) && empty($password_err) ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password,email) VALUES (:username, :password,:email)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email; // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
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
  	<p>Enter email<input type="email" name="email"></p>
  	
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
           

           
