<?php
	session_start();
    $pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','' );

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

            <div class="topnav">    
                
                <a href="home.php" class="active">Home</a>
                <a href="register.php">Register</a>
                <a href="view.php">Database</a>
                <a>ReportGeneration</a>
                <a href="settings.php">Settings</a>
                <a>Export</a>
                <a href="logout.php">Logout</a>
            </div>
            <div>
                <h1>Welcome Admin</h1>
            </div>
       </div>
    </body>
</html>