<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
   
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully<br>";

        // Create database
    $sql = "CREATE DATABASE myDB";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }

    ?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <br><a href="tablecreate.php">Create Table</a>
</body>
</html>
