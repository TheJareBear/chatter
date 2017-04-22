<?php
session_start ();

if (isset ( $_GET ['logout'] )) {

        // Simple exit message
        //$fp = fopen ( "log.html", 'a' );
        //fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['username'] . " has left the chat session.</i><br></div>" );
        //fclose ( $fp );
        //keep this stuff in just in case you want it to say this stuff
    session_destroy ();
    header ( "Location: ../index.php" ); // Redirect the user
}

if(isset($_SESSION['username']))
    {
?>

<html>
<head>
<title>Chatter Box - RandChat</title>
<link type="text/css" rel="stylesheet" href="../style.css" />
</head>
<body>
<h1>RANDOM CHATROOM</h1>
        <a href="../account.php">Account</a> |
        <a href="../about.php">About</a>
        <?php if(($_SESSION['username']) == 'admin') {echo '  |  <a href="../admin.php">Admin</a>';} ?>
<div id="wrapper">
        <div id="menu">
            <p class="welcome">
                Welcome, <b><?php echo $_SESSION['username']; ?></b>
            </p>
            <p class="logout">
                <a id="exit" href="#">Logout</a>
            </p>
            <div style="clear: both"></div>
        </div>
        <div id="chatbox"><?php
        if (file_exists ( "../logs/randomchat.html" ) && filesize ( "../logs/randomchat.html" ) > 0) {
            $handle = fopen ( "../logs/randomchat.html", "r" );
            $contents = fread ( $handle, filesize ( "../logs/randomchat.html" ) );
            fclose ( $handle );

            echo $contents;
        }
        ?></div>

        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" /> <input
                name="submitmsg" type="submit" id="submitmsg" value="Send" />
        </form>
    </div>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});

//jQuery Document
$(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){window.location = '../index.php?logout=true';}
    });
});

//If user submits the form
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        if(clientmsg.length > 0 && clientmsg.length < 150)
        {
          $.post("../postFunctions/postrand.php", {text: clientmsg});
          $("#usermsg").attr("value", "");
          loadLog;
        }
        else
        {
          alert("Message does not fit into length requirements (0<x<150)");
        }
    return false;
});

function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "../logs/randomchat.html",
        cache: false,
        success: function(html){
            $("#chatbox").html(html); //Insert chat log into the #chatbox div

            //Auto-scroll
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }
        },
    });
}

setInterval (loadLog, 200);
</script>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
</script>
<a href="../index.php">Home Chat Room</a> |
<a href="gamingchat.php">Gaming Chat Room</a> |
<a href="helpchat.php">Help Chat Room</a> |
Random Chat Room
<br><br><br><br><br>
<a href="../index.php">
<img src="../white.png" width="50" height="50">
</a>
</body>
</html>

<?php
    }
        else
            echo 'You must login <a href="../index.php">here</a>';
?>
