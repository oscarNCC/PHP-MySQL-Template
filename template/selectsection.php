<?php

if(isset($_COOKIE["username"])) {
   $username = $_COOKIE["username"]; 
   $password = $_COOKIE["password"];
   $server = "vlamp.cs.uleth.ca";
   $db = "osborn"; 
   $cno = $_POST['cno'];

   $conn = new mysqli($server,$username,$password,$db); 

   $sql = "select * from SECTION where cno='$cno'";

   $result = $conn->query($sql); 
   if($result->num_rows != 0) 
   { 	
      echo "<table border=1>";
      while($rec = $result->fetch_assoc()) {
    
		echo "<tr>";
		echo "<td>$rec[cno]</td>";
		echo "<td>$rec[secid]</td>";
		echo "<td>$rec[sem]</td>";
		echo "<td>$rec[yr]</td>";
		echo "</tr>";
      }
      echo "</table>";


   } else {

      echo "<p>Course $cno has no sections.</p>"; 
   
   }

}
else
{
  echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 

}

echo "<a href=\"main.php\">Return</a> to Home Page."; 

?>
