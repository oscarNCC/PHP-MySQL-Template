<?php

if (isset($_COOKIE["username"])) { 
   $username = $_COOKIE["username"];
   $password = $_COOKIE["password"];
   $server = "vlamp.cs.uleth.ca"; 
   $db = "osborn"; 
   $cno = $_POST['cno'];
   $secid = $_POST['secid'];
   $sem = $_POST['sem'];
   $yr = $_POST['yr'];
   

   $conn = new mysqli($server,$username,$password,$db);

   $sql = "insert into SECTION values ('$cno','$secid','$sem','$yr',NULL)";

   try {
     $conn->query($sql);
       echo "<p>New Section for course number $cno added!</p> "; 
   } catch (Exception $e) { 
     echo $e->getMessage();
   }

   echo "<a href=\"main.php\">Return</a> to Home Page."; 
} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
   
}

?>
 

