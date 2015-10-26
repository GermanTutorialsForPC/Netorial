<?php
session_start();
require_once('config.php');
if(isset($_SESSION['userid']))
{
    //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/home.php");
            exit;
}
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script>
		$(function(){
			$('#reg').mouseover(function() {
			  $(this).animate({
				opacity: 0.75,
				height: '300px'
			  }, 1000, function() {
				// Animation complete.
			  });
			});
			$('#reg').click(function() {
			  $(this).animate({
				opacity: 1.00,
				height: '15px'
			  }, 500, function() {
				// Animation complete.
			  });
			});    
		});
    </script>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"><form action="login.php" method="post">E-Mail: <input type="text" name="email" class="loginfield"></input> Passwort: <input type="password" name="password" class="loginfield"></input> <input type="submit" value="Login" name="submit"></input></form></div>
        <div id="reg">
        <b>Hier Registrieren</b></br></br>
        <form action="reg.php" method="post">
        Vorname:</br>
        <input type="text" name="prename" style="width:100%"></input></br>
        Nachname:</br>
        <input type="text" name="lastname" style="width:100%"></input></br>
        E-Mail Adresse:</br>
        <input type="mail" name="mail" style="width:100%"></input></br>
        E-Mail Adresse wiederholen:</br>
        <input type="mail" name="rmail" style="width:100%"></input></br>
        Passwort:</br>
        <input type="password" name="password" style="width:100%"></input></br>
        Passwort wiederholen:</br>
        <input type="password" name="rpassword" style="width:100%"></input></br>
        <input type="submit" name="reg" value="   Registrieren   "></input>
        </form>
        </div>
    </div>
    <div id="login-img">
    	<img src="designImages/netorial_login.png" alt="LoginGrafik" border="0"/>
    </div>
</body>    
</html>