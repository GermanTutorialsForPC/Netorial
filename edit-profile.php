<?php
session_start();
require_once('config.php');
if(!isset($_SESSION['userid']))
{
            //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/index.php");
            exit;
}
if(isset($_POST['submit']))
{
	$p = $_POST['id'];
	$selectIsUserProfile = mysql_query("SELECT * FROM profile WHERE administraedFrom = {$_SESSION['userid_ID']} AND id = {$p}");
	if(mysql_num_rows($selectIsUserProfile) > 0)
	{
		$profilname = $_POST['profiname'];
		$pI = "Musik:<br>" .$_POST['musik'] ." -_-_-_:-_:->|-#*## <br> Genutzte Software: <br>" .$_POST['software'] ." -_-_-_:-_:->|-#*## <br> Gibt Tutorials in: <br>" .$_POST['tutorials'] ." -_-_-_:-_:->|-#*## <br>Braucht Hilfe in: <br>" .$_POST['hilfe'] ." -_-_-_:-_:->|-#*## <br> Sonstiges: <br>" .$_POST['sonstiges'];
		$profilInfo = mysql_real_escape_string($pI);
		$update = mysql_query("UPDATE profile SET  profileName =  '{$profilname}', profilInfos =  '{$profilInfo}' WHERE  id ={$p}");
	}
	
	//Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/profile.php?p={$p}");
            exit;
	
}
$p = mysql_real_escape_string($_GET['p']);
$selectIsUserProfile = mysql_query("SELECT * FROM profile WHERE administraedFrom = {$_SESSION['userid_ID']} AND id = {$p}");
if(mysql_num_rows($selectIsUserProfile) > 0)
{
	$getUserMainProfil = mysql_query("SELECT * FROM profile WHERE administraedFrom = {$_SESSION['userid_ID']} AND id = {$p}");
}
else
{
	$getUserMainProfil = mysql_query("SELECT * FROM profile WHERE administraedFrom = {$_SESSION['userid_ID']} AND type = 1}");
}
//Daten aus datenbank Auslesen
$data = mysql_fetch_assoc($getUserMainProfil);
//Trennzeichen 	-_-_-_:-_:->|-#*##
$trenndata = str_replace("<br>", "" ,$data['profilInfos']);
$userProfileInfos = explode("-_-_-_:-_:->|-#*##", $trenndata);
$music = str_replace("Musik:", "", $userProfileInfos[0]);
$software = str_replace("Genutzte Software:", "", $userProfileInfos[1]);
$tutorials = str_replace("Gibt Tutorials in:", "", $userProfileInfos[2]);
$hilfe = str_replace("Braucht Hilfe in:", "", $userProfileInfos[3]);
$sonstiges = str_replace("Sonstiges:", "", $userProfileInfos[4]);
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"></div>
        <div id="content" style="background-image:none;">
            <div id="main-content" style="width:990px;">
            <h2>Profil bearbeiten</h2>
            <form action="edit-profile.php" method="post">
            Profilname:<br>
            <input type="text" name="profiname" style="width:100%" value="<?php echo  $data['profileName']; ?>"/><br>
            Musik:<br>
            <textarea name="musik" style="width:100%"><?php echo $music; ?></textarea>
            Genutzte Software:<br>
            <textarea name="software" style="width:100%"><?php echo $software; ?></textarea>
            Gibt Tutorials in:<br>
            <textarea name="tutorials" style="width:100%"><?php echo $tutorials; ?></textarea>
            Braucht Hilfe in:<br>
            <textarea name="hilfe" style="width:100%"><?php echo $hilfe; ?></textarea>
            Sonstiges:<br>
            <textarea name="sonstiges" style="width:100%"><?php echo $sonstiges; ?></textarea><br>
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="submit" value="   &Auml;ndern   " name="submit"/>
            </form>
        </div>
    </div>
</body>    
</html>