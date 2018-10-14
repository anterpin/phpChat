<?php
 session_start();

 ?>

<html>

  <head>



<?php

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
      h1{
            font-size:90px;
            font-family:monospace;
            text-decoration-color:red;
            text-align:center;}
        p { text-align: center;
            font-family: monospace;
            font-size:25px;}
          /* div {
              font-size: 35px;
              font-family: monospace;
              left:33%;
              top:0px;

          width: 150px;
          height: 150px;
          background-color: white;
          position: relative;
          animation-name: example;
          animation-duration: 8s;
          animation-iteration-count: 1;
      }

      /Standard syntax
      @keyframes example {
          0%   {background-color:white; left:33%; top:0px;}
          25%  {background-color:black; left:60%; top:0px;}
          50%  {background-color:white; left:60%; top:200px;}
          75%  {background-color:black; left:33%; top:200px;}
          100% {background-color:white; left:33%; top:0px;}
      }*/

      #big {
        display: :table;
        max-height:400px;
    }
      #chats{
        display: table-cell;
        width:50%;
        overflow-x:scroll;
        overflow-x: hidden;
        max-height: 400px;
        padding-left: 30px;
        padding-right: 30px;
      }
      #bottomConversation
      {
        position:absolute;
        bottom:10px;
        left: 50%;
        margin: 0 0 0 -45%;
      }
      #text-bar
      {
        border-radius: 20px;
        width:350px;
      }
      #e-mail{
        width:200px;
      }
      .buttons{
        width:97px;
      }
      #text-bar , .buttons,#email
      {
        border-radius: 20px;
        height:35px;
      }
      #option{
        border-radius: 25px;
        padding: 10px;
        width:400px;
        height:90px;
        background-color: rgba(0,170, 170, 0.6);
        border-color: #000000;
        border-style: solid;
      }
      #rightBlock
      {
        display: table-cell;
        border-style: solid;
        position:relative;
        margin:0 auto;
        width:50%;
        background-color: white;
        border-color:black;
        border-radius: 25px;
        padding-left: 30px;
        padding-right: 30px;
      }
      #divConversation{
        border-radius:25px;
          position:relative;
          font-family:monotone;
          overflow-y:scroll;
          overflow-x: hidden;
          max-width: 420px;
          color:white;
          scrollbar-base-color:gold;

          width:420px;;
          max-height: 250px;
          margin:10px;
          margin-bottom:30px;
          padding:5px;
      }
      #conversation{

      }


    .msgArrived
    {
      border-radius:20px;
      background-color: rgba(255,0,0,0.6);
      font-size:12px;
      padding:12px;

      margin:0px;
      color:white;

      max-width:230px;
    }
    .msgSent
    {
      border-radius:20px;
      background-color: rgba(0,0,255,0.6);
      font-size:12px;
      padding:12px;

      margin:0px;
      color:white;

      max-width:230px;

    }
      .avaibleChats
      {
        border-radius: 25px;
        padding: 10px;
        width:400px;
        height:40px;
        background-color: rgba(170,0, 0, 0.6);
        border-color: #000000;
        border-style: solid;
      }

      .riquadro
      {
        margin-right: 10%;
        margin-left:10%;
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

    var mess = "";
    function display_alert()
    {
     document.getElementById("message").innerHTML = mess;
    }
    function clear_alert()
    {
     document.getElementById("message").innerHTML = "";
    }
    var selected;
    function showRightDiv(tag)
    {
      var e = document.getElementById('rightBlock');
      e.style.display = 'table-cell';
      var person = document.getElementById("person");

      var str = tag.innerHTML.split(' ');
      var i=str[2].indexOf("<");
      //alert(str[2].substr(0,i));
      person.innerHTML = str[1]+" "+str[2];
    }
      var prevSelected;
    function onScroll(div)
    {

    if(!isset($_SESSION['logged']) || $_SESSION['logged'] !== true)
    {
      header("Location:./login.php");
      exit;
    }
      if(div.scrollTop!=0)
      {
        return;
      }
      if(div.offsetHeight<200)
      {
        return;
      }
      var e = document.getElementById('conversation');
      var text="";
      var h = e.offsetHeight;

      for(var i=0;i<10;i++)
      {
        text +="<tr><td width='180'></td><td width='180'><p class='msgSent'>"+"ciao "+i+"</p></td></tr>";
      }
      e.innerHTML = text+e.innerHTML;
      div.scrollTop=e.offsetHeight-h;
    }
    function deleteContentDiv()
    {
      var e = document.getElementById('conversation');
      e.innerHTML ="";
      var es = document.getElementById('text-bar');
      es.value="";

    }
    function hideRightDiv()
    {
      var e = document.getElementById('rightBlock');
      e.style.display = 'none';
    }

    function selection(tag)
    {
      let buttonDelete = document.getElementById('delete');

      if(selected!=null)
      {
          selected.style.background = 'rgb(170,0,0,0.6)';
          selected.style.width = 400;
          selected.style.height = 40;
      }

      if(tag==selected && selected !=null)
      {
        selected = null;
        prevSelected = tag;
        buttonDelete.disabled = selected ==null;
        tag.style.background = 'rgb(170,170,0,0.6)';
        tag.style.width = 410;
        tag.style.height = 41;
        hideRightDiv();
        deleteContentDiv();
        return;
      }
      if(prevSelected != tag )
      {
        deleteContentDiv();
      }
      prevSelected = null;
      showRightDiv(tag);
      tag.style.background = 'rgb(0,170,0,0.6)';
      tag.style.width = 420;
      tag.style.height = 42;
      selected = tag;

      buttonDelete.disabled = selected ==null;

    }
    function handler(max,inText)
    {
      var outText="";

      var currentWord="";
      var lineLength = 0;

      for(var i=0;i<inText.length;i++)
      {
        lineLength++;
        var char = inText[i];

        if(lineLength>max)
        {
          if(char==" ")
          {
            outText += currentWord+"<br/>";
            currentWord="";
          }
          else if(currentWord.length>max/2)
          {
            //we have to split the word
            outText += currentWord+"<br/>";
            currentWord=char;
          }
          else{
            outText +="<br/>";
            currentWord+=char;
          }
          lineLength = 0;
          continue;
        }
         if(char==" ")
        {
          outText+=currentWord+" ";
          currentWord = "";
        }
        else {
          currentWord +=char;
        }

      }
      outText+=currentWord+"<br/>";
      return outText;

    }

    function sendInserRequest(dest,msg)
    {
    +  var xmlhttp = new XMLHttpRequest();
      var textArea = document.getElementById('conversation');
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              if(this.responseText=="ok")
              {
                textArea.innerHTML += "<tr><td width='180'></td><td width='180'><p class='msgSent'>"+ handler(20,msg)+"</p></td></tr>";
                document.getElementById('divConversation').scrollTop = textArea.offsetHeight;
              }

          }
      };
      xmlhttp.open("GET", "sendMessage.php?chatid="+dest+"&message="+msg, true);
      xmlhttp.send();
    }
    function sendMessage()
    {
      var textbar = document.getElementById('text-bar');
     if(textbar.value==="")
        return false;
     var textArea = document.getElementById('conversation');

    // alert(handler(20,textbar.value));
      textbar.value="";


      return false;
    }
    function over(tag)
    {
      if(selected==tag)
      {
          return;
      }
      tag.style.background = 'rgb(170,170,0,0.6)';
      tag.style.width = 410;
      tag.style.height = 41;
    }

    function out(tag)
    {
      if(selected==tag)
      {
          return;
      }

      tag.style.background = 'rgb(170,0,0,0.6)';
      tag.style.width = 400;
      tag.style.height = 40;
    }

    </script>

    <script>
      function update()
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message").innerHTML = this.responseText;

            }
        };
        xmlhttp.open("GET", "update.php", true);
        xmlhttp.send();
      }

      function deleteChat()
      {
        if(selected==null)
            return;
        var text = selected.innerHTML;


        var mailI = text.lastIndexOf(">");
        var mail = text.substr(mailI+1);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText=="success")
                {
                  document.getElementById('delete').disabled = true;
                  document.getElementById("message").innerHTML = "Chat successfully deleted";
                  selected.remove();
                  selected = null;
                  deleteContentDiv();
                  hideRightDiv();
                }
                else
                {
                  document.getElementById("message").innerHTML = "Cannot delete this chat";
                }
              }
            };
        xmlhttp.open("GET", "deleteChat.php?mail="+mail, true);
        xmlhttp.send();

        return false;
      }
      function newChat()
      {

        var mail = document.getElementById('email').value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             var arr = this.responseText.split(" ");

                if(arr[0]=="created")
                {
                  var tag = document.getElementById('chats');
                  tag.innerHTML = "<h4>All chats:</h4><div class='avaibleChats' onmouseover='over(this)' onmouseout='out(this)' onclick='selection(this)'><b>"+arr[1]+" "+arr[2]+" "+arr[3]+"</b><br/>"+arr[4]+"</div>"+tag.innerHTML.substr("<h4>All chats:</h4>".length+8);
                  deleteContentDiv();com
                  selection(tag.children[1]);
                }
                else {
                  document.getElementById('message').innerHTML = this.responseText;
                }com
              }
            };
        xmlhttp.open("GET", "newChat.php?mail="+mail, true);
        xmlhttp.send();

        return false;
      }

      setInterval(update,1000);
      setTimeout(hideRightDiv,1);
    </script>
  </head>


  <body>
<div class='riquadro'>
    <font class="title">
      <h1>BENVENUTO</h1>

      <font>Welcome <?php echo $_SESSION['name']." ".$_SESSION['lastname'];?> <b>X</b></font>
      <br/>
    </font>
<br/><br/><br/><br/>
     <p id="message"></p>
     <form id="login" action="/logout.php" method="POST">
    <input type="submit" value="logout"/><br/>


     </form>
     <p id="message"></p>
     <div id='big'>

     <div id="chats">
       <h4>All chats:</h4>
       <?php
       $con=mysqli_connect("localhost","phpmyadmin","CIAOCIAO","LaApp");

       $query = "SELECT `chats`.* , `users`.* FROM `chats` INNER JOIN `users` ON ((`chats`.`member1`=`users`.`id` AND NOT `users`.`id` LIKE '".$_SESSION['id']."') OR (`chats`.`member2`=`users`.`id` AND NOT `users`.`id` LIKE '".$_SESSION['id']."')) WHERE `member1` LIKE '".$_SESSION['id']."' OR `member2` LIKE '".$_SESSION['id']."' ORDER BY `chats`.`time` DESC";

       $result = mysqli_query($con,$query);
       mysqli_close($con);


       if ($result->num_rows > 0)
       {
         while($row = $result->fetch_assoc())
         {
          /* if($_SESSION['id'] === $row['member1'])
              echo $row['member2'];
            else
              echo $row['member1'];*/
              echo "<div class='avaibleChats' onmouseover='over(this)' onmouseout='out(this)' onclick='selection(this)'><b>".$row['chatid'];
            echo " ".$row['name']." ".$row['lastname']."</b><br/>".$row['e-mail']."</div>";
           }
           //echo "<br/>";

        }
        else
        {
          echo "There is no chat";
        }



          ?>
          <div id="option">
          <form name="newC" onSubmit="return newChat();">
             <input id="email" type="email"width="150" placeholder="email@domain.ext"required/>

             <input type="submit" class="buttons"value="new XChat"/>
           </form>

              <button id='delete'class="buttons"style="width:130px;" onclick='deleteChat()'disabled='true'>Delete XChat</button>
          </div>
     </div>
     <div id='rightBlock'hidden>
       <div id="person">

       </div>
       <div id='divConversation' onscroll="onScroll(this)">
       <table id='conversation'>
         <tr><td width='180'></td><td width='180'><p class='msgSent'>dafadsfasdffffffff<br/></p></td></tr>
         <tr><td width='180'></td><td width='180'><p class='msgSent'>adsfdfasdfdsafasdfasdf<br/></p></td></tr>
         <tr><td width='180'><p class='msgArrived'>adsffffffffffffffffffff<br/></p></td><td width='180'></td></tr>
         <tr><td width='180'></td><td width='180'><p class='msgSent'>fdsadfdafdadfdsafsdafdsa<br/></p></td></tr>
       </table>
     </div>
       <div id="bottomConversation">
         <form name="sending" onSubmit="return sendMessage();">
            <input type="text" id='text-bar' placeholder="Scrivi qualcosa"/>

            <input id='sendMsg' type="submit" class="buttons" value="Send"/>
          </form>


     </div>



<br/>
<br/>





</div>
<p> &hearts; &spades; &diams; &clubs; </p>

<br> </br><br/><br/><br/><br/>
 <br> </br><br/><br/><br/><br/>
 <p> chat right now <p>
  </body>

</html>
