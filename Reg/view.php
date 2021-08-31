   
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/6f94d30cd9.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
	<style type="text/css">
		#header{
			background-image:repeating-radial-gradient(rgb(95, 95, 255),white);
    		padding: 20px 20px 20px 20px ;
    		text-align: center;

			}
			#myInput {
   /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}
 .fontuser {
            position: relative;
        }
          
        .fontuser i{
            position: absolute;
            left: 15px;
            top: 40px;
            color: gray;
        }
		</style>
	
</head>
<body>
	<div id ="header">
                <h1>MAST REGISTRATION PORTAL</h1>
                <h3>National Institute of Wind Energy</h3>
                <h4>(Ministry of New and Renewable Energy)</h4>
            </div>
	<div class="container">
	 
       <div class="fontuser">
        <form method="post" action="1-form.php">
      <p> <label><b>Search</b></label><input type="text" id="myInput" name="search" onkeyup="myFunction()" placeholder="Search by anything.."></p>
        <input type="submit" value="Search"/>
    </form>
      <i class="fas fa-search"></i></p>
  </div>


<?php
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );


$stmt1=$pdo->query("select count(Station_name) as num from register");
$user=$stmt1->fetch(PDO::FETCH_ASSOC);
if($user === false)
{
  echo "Bad value";
}

$start = 0;  $per_page = 2;
    $page_counter = 0;
    $next = $page_counter + 1;
    $previous = $page_counter - 1;
    
    if(isset($_GET['start'])){
     $start = $_GET['start'];
     $page_counter =  $_GET['start'];
     $start = $start *  $per_page;
     $next = $page_counter + 1;
     $previous = $page_counter - 1;
    }
    // query to get messages from messages table
    
    
    

    
    // count total number of rows in students table
    
    $count = $user['num'];
    // calculate the pagination number by dividing total number of rows with per page.
    $paginations = ceil($count / $per_page);
$stmt=$pdo->query( "SELECT * FROM register LIMIT $start, $per_page");
echo '<div class="container">';
     
     	echo '<table class="table table-hover">';
     		
  	
  		echo '<thead>';
  		echo "<tr>";
  		
  		echo "<th>";
  		echo "NIWE Reg NO";
  		echo "</th>";
  		echo "<th>";
  		echo "Site_Name";
  		echo "</th>";
  		echo "<th>";
  		echo "Site_Commenced_On";
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
  		echo "<th>";
  		echo "Client";
  		echo "</th>";
  		echo "<th>";
  		echo "Amount";
  		echo "</th>";
  		echo "<th>";
  		echo "Comment";
  		echo "</th>";
      echo "<th>";
      echo "Report";
      echo "</th>";
       echo "<th>";
      echo "Delete";
      echo "</th>";
  		echo "</tr>";
  		echo '</thead>';
  		while($row=$stmt->fetch(PDO::FETCH_ASSOC) )
  	{
  		echo '<tbody id="myTable">';
  		echo "<tr><td>";
  		
  		echo '<a href="edit.php?edit='.$row['SI_no'].'">'.$row['NIWE_Reg_No'].'</a>';
  		echo "</td><td>";
		echo(htmlentities($row['Station_name']));
  		echo "</td><td>";
  		echo(htmlentities($row['commision_date']));
  		echo "</td><td>";
  		echo(htmlentities($row['state']));
  		echo "</td><td>";
  		echo(htmlentities($row['latitude']));
  		echo "</td><td>";
  		echo(htmlentities($row['longitude']));
  		echo "</td><td>";
  		echo(htmlentities($row['Client']));
  		echo "</td><td>";
  		echo(htmlentities($row['amount']));
  		echo "</td><td>";
  		echo(htmlentities($row['comment']));
      echo "</td><td>";
      echo '<a href="report.php?userid='.$row['SI_no'].'">Report</a>';
      echo "</td><td>";
      echo '<a href="del.php?userid='.$row['SI_no'].'">Delete</a>';
      
  		echo "</td></tr>";
  		
  		echo '</tbody>';
	  		}
  		
  		
  		echo "</table>";
  		
    
    echo "</div>";


  	
  if(isset($_SESSION['error']))
    {
      echo '<p style="color:red">'.$_SESSION['error']."</p> \n";
      unset($_SESSION['error']);
    }
    if(isset($_SESSION['success']))
    {
      echo '<p style="color:green">'.$_SESSION['success']."</p> \n";
      unset($_SESSION['success']);
    }






?>
  



  	
  	<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

    
  	

  	<footer style="text-align: center; font-size: 30px; ">
  		
      <a href="home.html" style="color: red;" >Back to Home</a>
      <p> No of stations:<?= $user['num'] ?></p>
       <center>
        <form method="GET">
            <ul class="pagination">
            <?php

                if($page_counter == 0){
                    echo "<li><a href=?start=0 class='active'>0</a></li>";
                    for($j=1; $j < $paginations; $j++) { 
                      echo "<li><a href=?start=$j>".$j."</a></li>";
                   }
                }else{
                    echo "<li><a href=?start=$previous>Previous</a></li>"; 
                    for($j=0; $j < $paginations; $j++) {
                     if($j == $page_counter) {
                        echo "<li><a href=?start=$j class='active'>".$j."</a></li>";
                     }else{
                        echo "<li><a href=?start=$j>".$j."</a></li>";
                     } 
                  }if($j != $page_counter+1)
                    echo "<li><a href=?start=$next>Next</a></li>"; 
                } 
            ?>
            </ul>
          </form>
            </center>    
      
    </footer>
    </div>

  	
  </body>
  </html>



