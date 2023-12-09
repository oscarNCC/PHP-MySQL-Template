<?php

if (isset($_COOKIE["username"])) {
      
   $username = $_COOKIE["username"];
   $password = $_COOKIE["password"];
   $server = "vlamp.cs.uleth.ca"; 
   $db = "osborn"; 
   $dname = $_POST['dname']; 

   $conn = new mysqli($server,$username,$password,$db);

 $sql = "delete from DEPT where dname='$dname'";

try { 
   $conn->query($sql);
   echo "Department Deleted!\n";
   
   } catch (Exception $e) {
   echo $e -> getMessage(); 
}
  
   echo "<br><br><a href=\"main.php\">Return</a> to Home Page."; 
} else {
   
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
      
}
?>