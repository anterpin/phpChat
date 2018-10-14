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
    header("Location:./login.php?num=".$data);
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

  $_SESSION['email'] = $email;

$con=mysqli_connect("localhost","phpmyadmin","CIAOCIAO","LaApp");
// Check connection

$query = "SELECT * FROM `users` WHERE `e-mail` LIKE '".$email."'";

$result = mysqli_query($con,$query);
mysqli_close($con);

if ($result->num_rows > 0)
{
   $row = $result->fetch_assoc();

  $password_hash = $row["password_hash"];

  $password_from_user_hash = hash("sha256",$password);

  if($password_from_user_hash===$password_hash)
  {
    $_SESSION['id'] = $row["id"];
    $_SESSION['name'] = $row["name"];
    $_SESSION['lastname'] = $row["lastname"];
    $_SESSION['phone_number'] = $row["phone-number"];
    $_SESSION['gender'] = $row["gender"];
    $_SESSION['logged'] = true;

    header("Location:./secret.php");
    exit;
  }
  else
  {
    redirectHome(1);
  }

}
else
{
    redirectHome(2);
}



?>
