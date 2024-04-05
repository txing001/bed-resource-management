<?php
  session_start();

  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<html lang="en">
<head>
  <title> Elizabeth hotel bed management system  </title>
  <meta charset="utf-8">
  <link rel="stylesheet"  href="style.css">
</head>
<body>
<div id='wrapping' style="margin-top: 40px">
<header>
    <div class="logo">
      <img src="new_photo.png" width = "200" height = "100">
    </div>


    </header>
<h1>Log out</h1>
<?php
  if (!empty($old_user))
  {
    echo 'Logged out.<br />';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo 'You were not logged in, and so have not been logged out.<br /><br />';
  }
?>
<a href="login.php" style="color:blue">Back to Log in page</a><br>

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
