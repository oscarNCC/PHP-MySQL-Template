<html>
    <head><link rel="stylesheet" type="text/css" href="tablestyle.css"></head>
<?php


    $lastLoginTime = '';
    if (isset($_COOKIE["username"])) {
        $usernameFromCookie = $_COOKIE["username"]; 
              
        $server = "vlamp.cs.uleth.ca";
        $dbUsername = "chao3660";
        $dbPassword = "ne2iMeThai";
        $database = "chao3660";
        
        $con = mysqli_connect($server, $dbUsername, $dbPassword, $database);

        $query = "SELECT DATE_FORMAT(last_login_time, '%Y-%m-%d %H:%i:%s') AS last_login_time,name FROM admin WHERE username = '$usernameFromCookie'";

        $result = mysqli_query($con, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $name = $row["name"];
            $lastontime = $row['last_login_time'];
            
        }else {
            echo 'lastontime is empty';
        }
        echo "<h1>Welcome user :"  . $name . "</h1>";
        
        echo "<p>Select from one of the following operations:</p>
        
        <ul>
          <table class = 'table-style'>
            <tr>
                <th>Vehicle</th> 
                <th>Customer</th> 
                <th>Rental Transaction</th> 
                <th>Employee</th>
            </tr>
            <tr>
                <form action ='Vehicle/select.php'>
                <td><button>Select</button></td>
                </form>
                
                <form action ='Customer/select.php'>
                <td><button>Select</button></td>
                </form>
            
                <form action ='RentalTransaction/select.php'>
                <td><button>Select</button></td>
                </form>

                <form action ='Employee/select.php'>
                <td><button>Select</button></td>
                </form>

            </tr>
            <tr>
            <form action = 'Vehicle/insert.php'>
                <td><button>Insert</button></td>
            </form>
            <form action = 'Customer/insert.php'>
                <td><button>Insert</button></td>
            </form>
            
            <form action = 'RentalTransaction/insert.php'>
                <td><button>Insert</button></td>
            </form>

            <form action = 'Employee/insert.php'>
                <td><button>Insert</button></td>
            </form>
            
            </tr>
            <form action = 'Vehicle/update.php'>
                <td><button>Update</button></td>
            </form>

            <form action = 'Customer/update.php'>
                <td><button>Update</button></td>
            </form>   
            <form action = 'RentalTransaction/update.php'>
                <td><button>Update</button></td>
            </form>
                
            <form action = 'Employee/update.php'>
                <td><button>Update</button></td>
            </form>

            </tr>

            <tr>
            <form action ='Vehicle/delete.php'>
                <td><button>Delete</button></td>
            </form>

            <form action ='Customer/delete.php'>
                <td><button>Delete</button></td>
            </form>


            <form action ='RentalTransaction/delete.php'>
                <td><button>Delete</button></td>
            </form>
                
            <form action ='Employee/delete.php'>
                <td><button>Delete</button></td>
            </form>

            </tr>
      
         
           
            <tr>     
                <th colspan='3'></th>  
                <td class='red-th '>Add Admin </td>          

            </tr>
            <tr >     
                <th colspan='3' ></th>  
                <td >
                <form action = 'insertAdmin.php' method ='post' >
                Name 
                <input type='text' id='name' name='name' required><br>
                Username
                <input   type='text' id='username' name='username' required ><br>
                Password
                <input type='text' id='password' name='password' required><br>
                <input type='submit' value='Submit'>
                 </form> 
              </td>          
               
            </tr>
            </form>
        </table>  
      
   
        <p><a href='test/test_insert.html'>Test Page</a></p>
        
        <p><a href='logout.php'>Logout</a></p>";
        echo "Last login time: $lastontime"; 
        

    } else {
        echo "Please log in first.";
        echo "<p><a href='index.php'>Login page</a></p>";
        
    }
   
    ?>

</html>
