
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
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
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
      <p> <label><b>Search</b></label><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by anything..">
      <i class="fas fa-search"></i></p>
  </div>


<?php
$pdo = new PDO("mysql:host=localhost;dbname=NIWE;port=3306",'root','root' );
$stmt=$pdo->query("select * from register");
echo '<div class="container">';
     
     	echo '<table class="table table-hover">';
     		
  	
  		echo '<thead>';
  		echo "<tr>";
  		echo "<th>";
  		echo "SI no";
  		echo "</th>";
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
  		echo "</tr>";
  		echo '</thead>';
  		while($row=$stmt->fetch(PDO::FETCH_ASSOC) )
  	{
  		echo '<tbody id="myTable">';
  		echo "<tr><td>";
  		echo(htmlentities($row['SI_no']));
  		echo "</td><td>";
  		echo(htmlentities($row['NIWE_Reg_No']));
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
    
  	
</div>
<form action="edit.php" method="get">
  		<p style="text-align: center; font-size: 20px;"><input type="integer" name="edit" placeholder="SI no"><input type="submit" name="Edit" value="Edit"></p>
  	</form>
  	<footer style="text-align: center; font-size: 30px; ">
  		
      <a href="home.html" style="color: red;" >Back to Home</a>
    </footer>
  	
  </body>
  </html>



