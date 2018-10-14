<?php

session_start();
$mail = $_GET['mail'];
//echo $mail;
//exit;
$mymail = $_SESSION['email'];
$id;
$myid = $_SESSION['id'];

$iname;
$ilastname;

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
   $iname = $row['name'];
   $ilastname = $row['lastname'];
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



 if ($result2->num_rows != 0)
   {
     $row = $result2->fetch_assoc();

     echo "Already exits this chat ".$row['chatid'];
     mysqli_close($con);
     exit;
   }
   if($result3->num_rows != 0)
   {
     $row = $result3->fetch_assoc();

     echo "Already exits this chat ".$row['chatid'];
     mysqli_close($con);
     exit;
   }
   $query4 = "INSERT INTO `chats` (`member1`, `member2`, `chatid`,`lastmessage`,`time`) VALUES ".
   "('".$id."' , '".$myid."' , NULL,'',CURRENT_TIMESTAMP)";

   $result4 = mysqli_query($con,$query4);
   $result5 = mysqli_query($con,$query2);

   $row5 = $result5->fetch_assoc();
   $chatid = $row5['chatid'];

   $query_create = "CREATE TABLE `LaApp`.`m".$chatid."` ( `id` INT NOT NULL AUTO_INCREMENT , `from` INT(15) NOT NULL , `to` INT(15) NOT NULL , `message` VARCHAR(500) NOT NULL , `time` TIMESTAMP NOT NULL , PRIMARY KEY(`id`) ) ENGINE = InnoDB";
mysqli_query($con,$query_create);
  mysqli_close($con);



  echo "created ".$chatid." ".$iname." ".$ilastname." ".$mail;


?>
