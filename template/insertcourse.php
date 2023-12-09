<?php

if (isset($_COOKIE['username'])) { 
   $username = $_COOKIE['username'];
   $password = $_COOKIE['password'];
   $server = "vlamp.cs.uleth.ca";
   $db = "osborn"; 
   $cno = $_POST['cno'];
   $cname = $_POST['cname'];
   $crhrs = $_POST['crhrs'];
   $dname = $_POST['dname'];

   $conn = new mysqli($server,$username,$password,$db); 
   
   $sql = "insert into COURSE values ('$cno','$cname','$crhrs','$dname')"; 
   if($conn->query($sql)) 
   { 
   
      $sql = "insert into SECTION values ('$cno','A','Fall','2023',NULL)";
      $conn->query($sql);
      echo "<h3> Course and one section added!</h3>";
	
   }
   else {
      $err = $conn->errno; 
      if($err == 1062)
      {
	 echo "<p>Course Number $cno already exists!</p>"; 
      }
      else {
	 echo "error number $err"; 
      }
      
   }
   echo "<a href=\"main.php\">Return</a> to Home Page."; 
} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>"; 

}

?>
 

