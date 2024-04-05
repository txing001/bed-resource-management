
<?php
// Start a new session or resume the existing one
include "dbconnect.php";
session_start();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = 'yes you entered';
//    echo $message;
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        
        
        $message = '1';
        
        // Prepare the SQL statement to prevent SQL injection
          $query = 'select * from users '
                   ."where username='$username' "
                   ." and password='$password'";
//         echo "<br>" .$query. "<br>";
          $result = $dbcnx->query($query);
          $row=mysqli_fetch_assoc($result); //1111
          $user=$row['username']; //1111
          $key=$row['password'];
//          echo $username;
//          echo $password;
//          echo " test ";
//          echo $key;


        if ($result->num_rows > 0) {
//            echo " test 111";
            // Verify the password against the hashed password in the database
//            if (password_verify($password, $key)) {
            // ignore password hash first, will add in later
            if ($password == $key) {
//                echo " test 222";
                // Password is correct, start a session
                $_SESSION['valid_user'] = $username;
                $message = 'Login successful.';
                // Redirect or do something
            } else {
                $message = 'Login failed: Invalid username or password.';
            }
        } else {
            $message = 'Login failed: Invalid username or password.';
        }

//        $stmt->close();
        $dbcnx->close();
    } else {
        $message = 'Please enter username and password.';
    }

//    $conn->close();
}
?>


<html lang="en">
<head>
  <title> Elizabeth hotel bed management system </title>
  <meta charset="utf-8">
  <link rel="stylesheet"  href="style.css">
</head>
<body>
  <div id="wrapping" style="margin-top: 40px">

  <header>
    <div class="logo">
      <a href="login.php">
        <img src="new_photo.png" width = "200" height = "100"></a>
    </div>

        <div id="login" style="margin-top: 120px">


    <?php
      if ($_SESSION['valid_user'] != null)
      {
//          echo "<a href='login.php'>" Manage bed resources "</a>";
        
        echo "<tr>" .$_SESSION['valid_user']. "</tr>";
          echo '<tr><a style="color:blue;" href="login.php">      Main Page      </a></tr>';
          echo '<tr><a style="color:blue;" href="logout.php" align = "right">      Logout        </a></tr>';
        //  echo "<a href='appointment.php'>" manage bed resources "</a>";
      }
    else
{
    echo "Log in to manage bed resources";
}
     ?>
     </div>
    </header>
  <div class='content'>

    <?php
      if (isset($_SESSION['valid_user']))
      {
        echo 'You are logged in as: '.$_SESSION['valid_user'].' <br /><br />';
        echo '<a style="color:red;" href="logout.php">Log out</a><br /><br/>';
        echo '<a style="color:blue;" href="bedcheck.php">Search for a bed ID</a><br/><br/>';
        echo '<a style="color:blue;" href="assign.php">Allocate a bed based on occupied time</a><br/><br/>';


      }
      else
      {
        if (isset($username))
        {
          // if they've tried and failed to log in
          echo 'Could not log you in.<br />';
        }
        else
        {
          // they have not tried to log in yet or have logged out
          echo 'Please log in.<br />';
        }

        // provide form to log in
        echo '<form method="post" action="login.php">';
        echo '<table>';
        echo '<tr><td>Username:</td>';
        echo '<td><input type="text" name="username" required></td></tr>';
        echo '<tr><td>Password:</td>';
        echo '<td><input type="password" name="password" required></td></tr>';
        echo '<tr><td colspan="2" align="center">';
        echo '<input type="submit" value="Log in"></td></tr>';
        echo '</table></form>';
      }
    ?>
   </div>
   <footer>
      <div id="left">
          <img src='logo.png'>
          <h3 style="color: #2596be">Mount Elizabeth Hospital</h3>

          <h5>&copy;Raffles medical group</h5>
        </div>
      <div id='right'>
          <p>
            <h2>Contact us:</h2>
            <h3 style="color:#2596be">+65 6898 6898</h2>
            <a href="mailto:mountelizabeth@healthcare.com" style="color:#2596be">mountelizabeth@healthcare.com</a></p>
          <p><h3 style="color: #2596be">Contact +65 8941 5078 for urgent technical issues</h3></p>
        </div>
  </footer>
  </div>
</body>
</html>
