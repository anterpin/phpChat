
<?php

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function redirectHome($data)
{
    header("Location:./register.php?num=".$data);
    exit;
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] != "POST")
{
  redirectHome(4);
}
  $name =$lastname=$email=$password=$phone_number=$gender;

  session_start();


  if(isset($_POST["name"]))
  {
   $val = $_POST["name"];
   $name = test_input($val);
  }
  else
     redirectHome(3);
  if(isset($_POST["lastname"]))
  {
    $val = $_POST["lastname"];
    $lastname = test_input($val);
  }
  else
    redirectHome(3);
  if(isset($_POST["e-mail"]))
  {
    $val = $_POST["e-mail"];
    $email = test_input($val);
  }
  else
    redirectHome(3);
  if(isset($_POST["password"]))
  {
    $val = $_POST["password"];
    $password = test_input($val);
  }
  else
    redirectHome(3);
  if(isset($_POST["phone-number"]))
  {
    $val = $_POST["phone-number"];
    $phone_number = test_input($val);
  }
  else
    redirectHome(3);
  if(isset($_POST["gender"]))
  {
    $val = $_POST["gender"];
    $gender = test_input($val);
  }
  else
    redirectHome(3);


    $_SESSION['name'] = $name;
    $_SESSION['lastname']   = $lastname;
    $_SESSION['email']     = $email;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['gender']   = $gender;

$con=mysqli_connect("localhost","phpmyadmin","CIAOCIAO","LaApp");
// Check connection

  $query = "INSERT INTO `users` (`id`, `name`, `lastname`, `password_hash`, `e-mail`, `phone-number`,`gender`,`lastonline`) VALUES ".
  "(NULL, '".$name."' , '".$lastname."' , '".hash("sha256",$password)."' , '".$email."' , '".$phone_number."' , '".$gender."','2018-05-14 00:00:00')";

$result = mysqli_query($con,$query);

if(!$result)
{
  if(substr( mysqli_error($con), 0, 9 )==="Duplicate")
  {
    mysqli_close($con);
    redirectHome(2);
  }
}

mysqli_close($con);
redirectHome(1);


?>
