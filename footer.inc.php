<!--************************************************
Author: Cassidy Bullock
Date: April 30, 2018
Description: footer inclusion
************************************************-->
<?php
  //get contact information
  require ('connectDB.php');
  $q = "SELECT phone, address, email FROM location";
  $r = @mysqli_query($dbc, $q);
  $row = mysqli_fetch_array($r);
  $phone = $row[0];
  $address = $row[1];
  $email = $row[2];
  mysqli_close($dbc);
?>

<footer class="footer">
  <div class="container">
    <span class="text-muted"><?php echo $phone . " - " . $address . " - " . $email?></span>
  </div>
</footer>
