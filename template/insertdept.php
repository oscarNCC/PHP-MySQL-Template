<?php
if (isset($_COOKIE['username'])) { 
$username = $_COOKIE['username'];
$password = $_COOKIE['password'];
$server = "vlamp.cs.uleth.ca"; 
$db = "osborn";

try
{
$conn = new mysqli($server,$username,$password,$db);
} catch (Exception $e) {
	echo $e -> getMessage();   
}

$sql = "insert into DEPT (dname, loc, id) values ('$_POST[dname]','$_POST[loc]','$_POST[id]')"; 
if($conn->query($sql))  
{ 
	echo "<h3> Department added!</h3>";

} else {
   $err = $conn->errno; 
   if($err == 1062)
   {
      echo "<p>Department name $_POST[dname] already exists!</p>"; 
   } else {
      echo "<p>MySQL error code $err </p>"; 

   }
   
}

echo "<a href=\"main.php\">Return</a> to Home Page.";

} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
}
?>