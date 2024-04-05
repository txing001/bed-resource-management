<?php
// Start the session if you're using sessions
include "dbconnect.php";
session_start();
echo "test ".$_SESSION['test'].".";
echo "Your bed id is: ".$_SESSION['Bed_ID'].".";
echo "Your bed start time is: ".$_SESSION['start_time'].".";
echo "Your registration is: ".$_SESSION['valid_user'].".";


if ($_SESSION['Bed_ID'] != null)
{
  
  echo "succeed";
  //  echo "<a href='logout.php'>" manage bed resources "</a>";
}
else
{
echo "failed";
}
echo "!!!!!!!!";
// Retrieve $bedID from GET parameters
//if (isset($_GET['Bed_ID'])) {
//    $bedID = $_GET['Bed_ID'];
//    echo "Your registration is: 1 ".$bedID.".";
//    // You can now use $bedID to query your database or perform other actions
//
//    // Example: Fetch some information based on $bedID
//    // $info = fetchInformation($bedID);
//} else {
//    // If bedID isn't passed, redirect back or show an error
//    echo "No bed ID provided.";
//    exit();
//}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Result</title>
</head>
<body>
    <h1>Check Result for Bed ID: </h1>

</body>
</html>

