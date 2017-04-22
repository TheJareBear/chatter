<?php
session_start ();
function loginForm() {
    echo "
   <div id='loginform'>
   <form action='index.php' method='post'>
        <input name='username' id='username' size='10' placeholder='Username' type='text'>
        <input name='password' id='password' size='10' placeholder='Password' type='password'>
        <br><br>
        <input type='submit' name='submit' value='Login'>
        <button type='button' onclick='window.location.href = `register.php`'>Register</button>
    </form>
</div>
   ";
}

if (isset ( $_GET ['logout'] )) {
    session_destroy ();
    header ( "Location: index.php" ); // Redirect the user
}

?>
<html>
<head>
<title>Chatter Box - Home</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    if (! isset ( $_SESSION ['username'] )) {
        echo '<h1>LOGIN</h1>';
        loginForm ();
    } else {
        ?>
        <h1>HOME CHATROOM</h1>
        <a href="account.php">Account</a> |
        <a href="about.php">About</a>
        <?php if(($_SESSION['username']) == 'admin') {echo '  |  <a href="admin.php">Admin</a>';} ?>
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
        if (file_exists ( "logs/homechat.html" ) && filesize ( "logs/homechat.html" ) > 0) {
            $handle = fopen ( "logs/homechat.html", "r" );
            $contents = fread ( $handle, filesize ( "logs/homechat.html" ) );
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
        if(exit==true){window.location = 'index.php?logout=true';}
    });
});

//If user submits the form
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();

        if(clientmsg.length == 0 || clientmsg.length > 150)
        {
          alert("Message does not fit into length requirements (0<x<150)");
        }
        else if(!(/\S/.test(clientmsg)))
        {
          alert("Messages cannot be all spaces");
        }
        else {
          $.post("postFunctions/posthome.php", {text: clientmsg});
          $("#usermsg").attr("value", "");
          loadLog;
        }

    return false;
});

function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "logs/homechat.html",
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
Home Chat Room |
<a href="chatrooms/gamingchat.php">Gaming Chat Room</a> |
<a href="chatrooms/helpchat.php">Help Chat Room</a> |
<a href="chatrooms/randomchat.php">Random Chat Room</a>

<?php
    }
    ?>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
</script>
</body>
</html>

<!--IMPORTANT -->
<?php include('login.php'); ?>
