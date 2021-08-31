<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/6f94d30cd9.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>
  <body>
    <!-- (A) SEARCH FORM -->
    

    <?php
    // (B) PROCESS SEARCH WHEN FORM SUBMITTED
    if (isset($_POST['search'])) {
      // (B1) SEARCH FOR USERS
      require "2-search.php";
      
      // (B2) DISPLAY RESULTS
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
      if (count($results) > 0) {
        foreach ($results as $r) {
         echo '<tbody id="myTable">';
      echo "<tr><td>";
      
      echo '<a href="edit.php?edit='.$r['SI_no'].'">'.$r['NIWE_Reg_No'].'</a>';
      echo "</td><td>";
    echo(htmlentities($r['Station_name']));
      echo "</td><td>";
      echo(htmlentities($r['commision_date']));
      echo "</td><td>";
      echo(htmlentities($r['state']));
      echo "</td><td>";
      echo(htmlentities($r['latitude']));
      echo "</td><td>";
      echo(htmlentities($r['longitude']));
      echo "</td><td>";
      echo(htmlentities($r['Client']));
      echo "</td><td>";
      echo(htmlentities($r['amount']));
      echo "</td><td>";
      echo(htmlentities($r['comment']));
      echo "</td><td>";
      echo '<a href="report.php?userid='.$r['SI_no'].'">Report</a>';
      echo "</td><td>";
      echo '<a href="del.php?userid='.$r['SI_no'].'">Delete</a>';
      
      echo "</td></tr>";
      
      echo '</tbody>';
          
        }
        echo "</table>";
      
    
    echo "</div>";

      }
       else 
        { echo "No results found"; }
      
    }
    ?>
  </body>
</html>