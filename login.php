<html>
  <head>
  <script>

  var mess = "";
  function display_alert()
  {
   document.getElementById("message").innerHTML = mess;
  }
  function clear_alert()
  {
   document.getElementById("message").innerHTML = "";
  }

  </script>
<?php
  session_start();
  if(isset($_SESSION['logged']))
  if($_SESSION['logged'] == true)
  {
    header("Location:/secret.php");
    exit;
  }


  $_SESSION['logged'] = false;

if(isset($_GET['num']))
{
  $error = $_GET['num'];
  $message;
  $notify = false;
  switch($error)
  {
    case "1":
      $message = "wrong password";
      $notify = true;
      break;
    case "2":
      $message = "email cannot be found";
      $notify = true;
      break;
    default: break;
  }

    echo("<script>mess = '".$message."';setTimeout(display_alert,20);setTimeout(clear_alert,4000);</script>");

}


 ?>

    <style>
    .title { -webkit-text-stroke: 2px red;}
      body
      {
          text-align:center;
          background-image: url("MICKEY.jpeg");
          background-repeat: no-repeat;
          background-position: top center;
          background-attachment: fixed;
      }
      div
      {
        margin-right: 30%;
        margin-left:30%;
        padding-right: 5px;
        padding-left: 5px;
        border-style: solid;
        border-color:red;
      }
      font
      {
          font-size: 43px;
          color: black;
          font-family: monospace;
      }
      .test
      {
        height :100px;
        width:200px;
        font-size: 30px;
      }
    </style>
    <script>

    </script>
  </head>


  <body>
<div>
    <font class="title">
      <h1>BENVENUTO</h1>

      <font>Welcome to <b>X</b></font>
      <br/>
    </font>
<br/><br/><br/><br/>
     <p id="message"></p>
<form id="login" action="/log.php" method="POST">
    <table align="center">
     <tr>
       <td>e-mail:</td>
       <td><input name="e-mail" type="email"autocomplete="on" placeholder="email@domain.ext"value =<?php echo "'";echo isset($_SESSION["email"])?$_SESSION["email"]:"";echo"'";?>required/><br/></td>
     </tr>
     <tr>
       <td>password:</td>
       <td><input name="password" type="password"placeholder="xxxxxxxxxxx"required/><br/></td>
     </tr>
     <td></td>
     <td><input type="submit" value="login"/><br/></td>
   </table>

</form>
<br/>
<a href="http://10.0.0.136/register.php">Haven't signed int?</a>
<br/>
<p> &spades; &diams; &hearts;  &clubs; </p>

</div>
  </body>

</html>
