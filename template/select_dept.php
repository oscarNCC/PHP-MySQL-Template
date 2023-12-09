<html>
<head><title>University of Wendy</title></head>
<body>
<?php

try{

  
if(isset($_COOKIE["username"]))
{
   echo "<form action=\"selectdept.php\" method=post>";
	
   $username = $_COOKIE["username"];
   $password = $_COOKIE["password"];	
   $server = "vlamp.cs.uleth.ca";
   $db = "osborn"; 

   try {
   $conn = new mysqli($server,$username,$password, $db);
   } catch (Exception $e){
      echo $e->getMessage(); 
      echo "Error connecting!";
      exit; 
   }

   $sql = "select dname from DEPT";

   try {
   $result = $conn->query($sql);
   } catch (Exception $e) {
      echo $e->getMessage(); 
      echo "Problem with processing query";
      exit; 
   }

   if($result->num_rows > 0)
   {
      echo "Department Name: <select name=\"dname\">";
	      
      while($val = $result->fetch_assoc())
      {
	 echo "<option value='".$val['dname']."'>".$val['dname']."</option>"; 
	      
      }
      echo "</select>"; 
      echo "<input type=submit name=\"submit\" value=\"View\">"; 
   }
   else
   {
      echo "<p>There are no Departments in the system!</p>"; 
   }
   
   echo "</form>";
}
else echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>";

} catch (PDOException $ex) {

   echo $ex->getMessage(); 
  }

?>


 
</body>
</html>
