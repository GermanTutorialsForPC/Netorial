<?php
session_start();
require('config.php');
if(!isset($_SESSION['userid']))
{
            //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/index.php");
            exit;
}
//Seite anlegen
if($_POST['creat'])
{
	//Eingaben absichern, auf SQL-Injection
	$name = mysql_real_escape_string($_POST['name']);
	//In die Datenbank schreiben
	$insertProfile = mysql_query("INSERT INTO groupData (id ,groupName, admin) VALUES('', '{$name}', '{$_SESSION['userid_ID']}')") or die(mysql_error());
}
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"><?php echo $friendship_request; ?><a href="profile.php?p=<?php echo $userProfile['id']; ?>">Mein Profil</a></div>
        <div id="content">
            <div id="navi"><a href="creat_page.php">Seite anlegen</a></div>
            <div id="main-content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Name:<br>
            <input type="text" name="name" style="width:100%;"/><br>
            <input type="submit" name="creat" value="Erstellen"/>
            </div>
        </div>
    </div>
</body>    
</html>