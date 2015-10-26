<?php
session_start();
//Datenbankverbindung
require_once('config.php');
//Loginprozess
$email = $_POST['email'];
$password = $_POST['password'];
if($email != "" && $password != "") {
    $email = mysql_real_escape_string($email);
    $password = md5($password);
    //Daten aus Datenbanak holen
    $selectUserData = mysql_query("SELECT * FROM user WHERE email = '{$email}'");
    //Ist der Benutzer Ÿberhaupt vorhanden?
    if(mysql_num_rows($selectUserData) > 0){
        //Aufarbeiten der Datenbankwerte
        $dbData = mysql_fetch_assoc($selectUserData);
        if($dbData['password'] == $password){
            $userip = $_SERVER['REMOTE_ADDR'];
            $userid = $dbData['id'];
            $insert = mysql_query("INSERT INTO loginlog VALUES ('','{$userid}','{$userip}')");
            $_SESSION['userid_ID'] = $userid;
			//ProfilID erhalten
			$selectMainProfilID = mysql_query("SELECT id FROM profile WHERE administraedFrom = {$userid}");
			$prifileIDArray = mysql_fetch_assoc($selectMainProfilID);
			$_SESSION['userid'] = $prifileIDArray['id'];
            //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/home.php");
            exit;
        }
        else{
            $output = "Falsches Passwort.";
        }
    }
    else{
     $output = "Der Benutzer ist nicht vorhanden.";    
    }
}
else{
        $output = "Bitte f&uuml;llen Sie alle Felder aus.";
}
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi" style="text-align:right;"><form action="login.php" method="post"><b>Fehler: <?php echo $output; ?></b>E-Mail: <input type="text" name="email" style="width:100px;"></input> Passwort: <input type="password" name="password" style="width:100px;"></input> <input type="submit" value="Login" name="submit"></input></form></div>
    </div>
    <div id="login-img">
    <img src="designImages/netorial_login.png" alt="LoginGrafik" border="0"/>
    </div>
</body>    
</html>