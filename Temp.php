<?php
  $conn = mysqli_connect('localhost','root','','myclinic');
  $query = "INSERT INTO temperature(Temp) VALUES('".$_GET["Temp"]."')";
  mysqli_query($conn, $query);
 ?>
