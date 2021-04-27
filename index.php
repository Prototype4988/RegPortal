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
                <form id="login" method="get" action="login.php">       
                    <input type="text" name="Uname" id="Uname" placeholder="Username">    
                    <br><br>    
                    <input type="Password" name="Pass" id="Pass" placeholder="Password">    
                    <br><br>    
                    <button type="submit" name="submit" id="log">Login</button>
                    <br><br>    
                    <a href="#">Forgot Password</a>    
                </form>     
            </div>    


        </div>
    </body>
</html>