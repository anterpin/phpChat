<?php

session_start();
$mail = $_GET['mail'];
//echo $mail;
//exit;
$mymail = $_SESSION['email'];
$id;
$myid = $_SESSION['id'];

if($mail===$mymail)
{
  echo "Your e-mail is not valid option.";
  exit;
}

$con=mysqli_connect("localhost","phpmyadmin","CIAOCIAO","LaApp");
// Check connection
$query = "SELECT * FROM `users` WHERE `e-mail` LIKE '".$mail."'";

$result = mysqli_query($con,$query);
if ($result->num_rows > 0)
{
   $row = $result->fetch_assoc();
   $id = $row['id'];
 }
 else
 {
   echo "There is not such e-mail";
   mysqli_close($con);
   exit;
 }

$query2 = "SELECT * FROM `chats` WHERE `member1` LIKE '".$id."' AND `member2` LIKE '".$myid."'";
$query3 = "SELECT * FROM `chats` WHERE `member2` LIKE '".$id."' AND `member1` LIKE '".$myid."'";

 $result2 = mysqli_query($con,$query2);
 $result3 = mysqli_query($con,$query3);

  $chatid ;
  if ($result2->num_rows != 0)
   {
     $row = $result2->fetch_assoc();
     $chatid = $row['chatid'];
   }
   else if($result3->num_rows != 0)
   {
     $row = $result3->fetch_assoc();
     $chatid = $row['chatid'];
   }
   else
   {
     mysqli_close($con);
     echo "there isn't this mail";
     exit;
   }
   $query_drop = "DROP TABLE `m".$chatid."`";
   $query_delete = "DELETE FROM `chats` WHERE `chatid` LIKE '".$chatid."'";

   $result_drop = mysqli_query($con,$query_drop);
   $result_delete = mysqli_query($con,$query_delete);

    echo "success";

   exit;

 ?>
