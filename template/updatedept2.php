<?php
if (isset($_COOKIE["username"])) { 
$username = $_COOKIE["username"];
$password = $_COOKIE["password"];
$server = "vlamp.cs.uleth.ca";
$db = "osborn"; 

try {
$conn = new mysqli($server,$username,$password,$db);
} catch (Exception $e) {
  echo $e->getMessage();
  exit; 
}

$sql = "update DEPT set dname='$_POST[dname]',loc='$_POST[loc]',id='$_POST[id]' where dname='$_POST[oldname]'"; 

try
{
	$conn->query($sql); 
	echo "<h3> Department updated!</h3>";

} catch (Exception $e) {
  
   $err = $conn->errno; 
   if($err == 1062)
   {
      echo "<p>Department name $_POST[dname] already exists!</p>"; 
   } else {
      echo "error code $err";
   }
   
}

echo "<a href=\"main.php\">Return</a> to Home Page.";

} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 
}
?>