<?php
  session_start();

$con=mysqli_connect("localhost","phpmyadmin","CIAOCIAO","LaApp");
// Check connection

$query = "SELECT * FROM `users` WHERE `e-mail` LIKE '".$_SESSION['email']."'";


$result = mysqli_query($con,$query);
if ($result->num_rows > 0)
{
   $row = $result->fetch_assoc();
   $timestamp = strtotime($row['lastonline']);
   $time = time();
   $timepassed = $time-$timestamp;

   $updatelast = "UPDATE `users` SET `lastonline` = NOW() WHERE `users`.`id` = ".$_SESSION['id'];
   mysqli_query($con,$updatelast);

   if($timepassed > 7)
   {
     $insertDiscon =  "INSERT INTO `logs` (`id`, `time`,`ip_v4`,`online`) VALUES ('".$_SESSION["id"]."', '".$row['lastonline']."','".$_SERVER['REMOTE_ADDR']."','0')";
     $insertAccess = "INSERT INTO `logs` (`id`, `time`,`ip_v4`,`online`) VALUES ('".$_SESSION["id"]."', '".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."','1')";
     mysqli_query($con,$insertDiscon);
     mysqli_query($con,$insertAccess);
     $update =0;

   }

 }
 else{
   echo "error<br/>";
 }
  mysqli_close($con);
  echo date("H:i:s");

 ?>
