<html>
<head><title>University of Wendy</title></head>
<body>



<?php
if(isset($_COOKIE['username'])){

   echo "<form action=\"updatedept.php\" method=post>";

   $username = $_COOKIE['username'];
   $password = $_COOKIE['password'];
   $server = "vlamp.cs.uleth.ca"; 
   $db = "osborn"; 

try {
   $conn = new mysqli($server,$username,$password,$db);
} catch (Exception $e) {
echo $e->getMessage();
exit; 
}

   $sql = "select dname from DEPT"; 
   $result = $conn->query($sql);
   if($result->num_rows != 0)
   {
      echo "Department Name: <select name=\"dname\">";
	      
      while($val = $result->fetch_assoc())
      {
	 echo "<option value='$val[dname]'>$val[dname]</option>"; 

      }
      echo "</select>"; 
      echo "<input type=submit name=\"submit\" value=\"View\">"; 
   }
   else
   {
      echo "<p>Umm...you may want to enter some data. ;) </p>"; 
   }

   echo "</form>";
}
else
{
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
}

?>


 
</body>
</html>
