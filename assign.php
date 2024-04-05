
<?php
// Start a new session or resume the existing one
include "dbconnect.php";
session_start();

    $checkindate = $_POST['checkin_date'];
    $checkoutdate = $_POST['checkout_date'];
//    echo $checkindate;
          $query = 'select * from bed '
                   ."where (date('$checkindate') >= occupied_end_date or date('$checkoutdate') <= occupied_start_date)";
                    "or (occupied_end_date is null and occupied_start_date is null)";
                        

          $result = $dbcnx->query($query);
            $options =array();
            while($row=mysqli_fetch_array($result))
            {
                   $options[] =$row;
            }
if ($result->num_rows > 0) {

    $_SESSION['checkindate'] = $checkindate;
    $_SESSION['checkoutdate'] = $checkoutdate;
        $_SESSION['get_result'] = 'yes';

}
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
    if (isset($_SESSION['checkindate'])){
        echo '<br>Below is the list of available bed ID:<br>';
        foreach($options as $option):
            echo "<br>Bed ".$option['bed_ID'].'<br>';
        endforeach;
//        unset($_SESSION['checkindate']);
//        unset($_SESSION['checkoutdate']);
//        unset($options);
        $_SESSION['bed_result'] = $options;
//        echo "Proceed to allocate the bed ID with a patient ID";
        echo '<a style="color:blue;" href="assign_bed.php">Proceed to allocate the bed ID with a patient ID</a><br/><br/>';

        
    }

        
        
        
else{
    if (isset($_SESSION['valid_user']))
    {
        
        // provide form to log in
        echo '<form method="post" action="assign.php">';
        echo '<table>';
        
        echo '<tr><td colspan="4" >Assign a bed to a patient by stay time: </td></tr>';
        
        echo '<h4 style="color:#2596be">*Note: By default, checkin time is 3pm and checkout time is 12pm daily. </h4>';
        echo '<tr><td>Checkin Date:</td>';
        echo '<td><input type="date" name="checkin_date" required></td></tr>';
        echo '<tr><td>Checkout Date:</td>';
        echo '<td><input type="date" name="checkout_date" required></td></tr>';
        echo '<tr><td><input type="submit" value="Search"></td></tr>';
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

