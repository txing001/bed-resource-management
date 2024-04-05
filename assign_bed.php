
<?php
// Start a new session or resume the existing one
include "dbconnect.php";
session_start();

$bedID = $_POST['Bed_ID'];
$PatientID = $_POST['Patient_ID'];

    $checkindate =$_SESSION['checkindate'];
    $checkoutdate =$_SESSION['checkoutdate'];
//    echo $bedID;
//    echo $checkindate;

    $query = "update bed set occupied_start_date = '$checkindate',occupied_end_date = '$checkoutdate', patientID = '$PatientID' where bed_ID ='$bedID'";


//    $result = $dbcnx->query($query);
//    $dbcnx->query($query);
//if ($dbcnx->query($sql) === TRUE) {
//    $_SESSION['valid_bed'] = 'yes';
//} else {
//    $_SESSION['valid_bed'] = 'no';
//}
$dbcnx->close();
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
    if ($_SESSION['valid_bed'] == 'yes'){
        echo "Your assignment is confirmed, with details below:";
        echo '<table>';
        echo '<tr><td>bed ID:</td>';
        echo "<td>".$bedID."</td>";
        echo '<tr><td>patient ID:</td>';
        echo "<td>".$PatientID."</td></tr>";
        echo '</table>';
        echo '<a style="color:blue;" href="login.php">Return to the main page</a><br/><br/>';
        }
        
        
        else{
      if (isset($_SESSION['valid_user']))
    {

      // provide form to log in
      echo '<form method="post" action="assign_bed.php">';
      echo '<table>';

      
//    if ($_SESSION['found'] == 'No'){
//          echo '<h3 style="color: red">Error. Please enter the correct bed ID</h3>';
//      }
      
      echo '<tr><td colspan="4" >Enter the bed ID and patient ID to complete your assignment: </td></tr>';

      echo '<tr><td>bed ID:</td>';
      echo '<td><input type="text" name="Bed_ID" required></td></tr>';
      echo '<tr><td>patient ID:</td>';
      echo '<td><input type="text" name="Patient_ID" required></td></tr>';
      echo '<tr><td><input type="submit" value="Assign"></td></tr>';
//        if ($_SESSION['valid_bed'] == 'No'){
//              echo '<h3 style="color: red">Error. Please enter the correct bed ID</h3>';
//          }
        $_SESSION['valid_bed'] = 'yes';
      echo '</table></form>';
    }
      else
      
    {
      echo 'You are logged in as: '.$_SESSION['valid_user'].' <br /><br />';
      echo '<a style="color:red;" href="logout.php">Log out</a><br /><br/>';
      echo '<a style="color:blue;" href="assign.php">Manage bed resources here!</a><br/><br/>';


    }
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

