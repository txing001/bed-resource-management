
<?php
// Start a new session or resume the existing one
include "dbconnect.php";
session_start();


//    echo $message;
    $bedID = $_POST['Bed_ID'];
//echo $bedID;
    
        
        if (!empty($bedID)){
        
        // Prepare the SQL statement to prevent SQL injection
          $query = 'select * from bed '
                   ."where bed_ID='$bedID' ";

          $result = $dbcnx->query($query);
          $row=mysqli_fetch_assoc($result);
          $bed_return=$row['bed_ID'];
          $start_date = $row['occupied_start_date'];
          $end_date = $row['occupied_end_date'];



        if ($result->num_rows > 0) {
        $_SESSION['found'] = 'Yes';
        $_SESSION['Bed_ID'] =$bedID;
        $_SESSION['start_date'] =$start_date;
        $_SESSION['end_date'] =$end_date;
        } else {
            $_SESSION['found'] = 'No';
            //echo " Please enter the correct bed ID";
        }

        $dbcnx->close();}

//    $conn->close();

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
        
        echo "<tr>" .$_SESSION['valid_user']. "</tr>";
          echo '<tr><a style="color:blue;" href="login.php">      Main Page      </a></tr>';
          echo '<tr><a style="color:blue;" href="logout.php" align = "right">      Logout        </a></tr>';
          
        //  echo "<a href='logout.php'>" manage bed resources "</a>";
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
        if (isset($_SESSION['Bed_ID'])){
            echo " You have entered a bed ID as:".$_SESSION['Bed_ID']."";
            echo "<br>This bed will be occupied from:" .$start_date. " 3:00pm,</br>";
            echo "and available from:" .$end_date. " 12:00pm.";
            unset($_SESSION['Bed_ID']);
            echo '<br><a style="color:blue;" href="bedcheck.php">Search again</a><br/>';
            
        }
        
        
        
        else{
      if (isset($_SESSION['valid_user']))
    {

      // provide form to log in
      echo '<form method="post" action="bedcheck.php">';
      echo '<table>';
      echo '<tr> Check a bed ID:</tr>';
      echo '<tr><td>Bed ID:</td>';
      echo '<td><input type="text" name="Bed_ID"></td>';
      echo '<td><input type="submit" value="check"></td></tr>';
      
    if ($_SESSION['found'] == 'No'){
          echo '<h3 style="color: red">Error. Please enter the correct bed ID</h3>';
      }
      
      //echo '<tr><td>   </td></tr>';
      echo '</table></form>';
    }
      else
      
    {
      echo 'You are logged in as: '.$_SESSION['valid_user'].' <br /><br />';
      echo '<a style="color:red;" href="logout.php">Log out</a><br /><br/>';
      echo '<a style="color:blue;" href="bedcheck.php">Manage bed resources here!</a><br/><br/>';


    }}
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

