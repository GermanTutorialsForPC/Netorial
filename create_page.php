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
if($_POST['create'])
{
	//Eingaben absichern, auf SQL-Injection
	$name = mysql_real_escape_string($_POST['name']);
	$ueber = mysql_real_escape_string($_POST['ueber']);
	$link = '<a href="' .mysql_real_escape_string($_POST['ws']) .'">' .mysql_real_escape_string($_POST['ws']) .'</a>';
	//Infowert
	$info = "&Uuml;ber uns:<br>" .$ueber ." -_-_-_:-_:->|-#*## <br> Website: <br>" .$link;
	//In die Datenbank schreiben
	$insertProfile = mysql_query("INSERT INTO profile (id ,administraedFrom ,type ,profileName, profilInfos) VALUES('', '{$_SESSION['userid_ID']}', '2', '{$name}', '{$info}')") or die(mysql_error());
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
            <div id="navi"><a href="create_page.php">Seite anlegen</a></div>
            <div id="main-content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Name:<br>
            <input type="text" name="name" style="width:100%;"/><br>
            &Uuml;ber diese Seite:<br>
            <textarea name="ueber" style="width:100%; height:75px;"></textarea><br>
            Website:<br>
            <input type="text" name="ws" style="width:100%;"/>
            <input type="submit" name="create" value="   Seite erstellen   "/>
            </form>
            </div>
        </div>
    </div>
</body>    
</html>