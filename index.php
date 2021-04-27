<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','' );
if(isset($_POST['pass']))
{
 $stmt = $pdo->prepare("select Username from login where Password=ENCODE(:password,'secret')");
    $stmt->execute([':password' => $_POST['pass']]); 
    $user = $stmt->fetch();
    echo "<table border=2 >"."\n";
     echo "<tr><td>";
    print_r($user['Username']);
    echo "</td></tr>";
    echo "</table>";
    $var1 = $user['Username'];
}
if(isset($_POST['name']))
{
    $stmt = $pdo->prepare("select DECODE(Password,'secret') as pass from login where Username=:name;");
    $stmt->execute([':name' => $_POST['name']]); 
    $user = $stmt->fetch();
    $var2 = $user['pass'];
    echo($var2);


}
if(isset($_POST['pass']) && isset($_POST['name']))
{
if(strcmp($_POST['pass'],$var2)== 0  &&  strcmp($_POST['name'], $var1) == 0)
    {
        echo "Valid user";
        header("location:home.php");
    }
    else
    {
        echo "<p class='error'>Try again</p>";
        header("location:index.php");
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>MAST REGISTRATION PORTAL</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
        <div id="container">
            <div id ="header">
		        <?php include "header.php" ?>
            </div>

            <div class="login">    
                <form id="login" method="post" >       
                    <input type="text" name="name" id="Uname" placeholder="Username">    
                    <br><br>    
                    <input type="Password" name="pass" id="Pass" placeholder="Password">    
                    <br><br>    
                    <button type="submit" name="submit" id="log">Login</button>
                    <br><br>    
                    <a href="#">Forgot Password</a>    
                </form>     
            </div>    


        </div>
    </body>
</html>