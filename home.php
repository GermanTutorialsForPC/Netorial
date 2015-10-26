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
if(isset($_POST['pinnwand']) && $_POST['pinnwand'] != "" && $_POST['pinnwand'] !="Dein Status")
{
	date_default_timezone_set("Europe/Berlin");
	$date = date("Y-m-d H:i:s");
	$pw = mysql_real_escape_string($_POST['pinnwand']);
	$uid = mysql_real_escape_string($_SESSION['userid']);
	$insert = mysql_query("INSERT INTO pinnwand VALUES('','{$pw}','{$uid}','{$uid}','{$date}')");
}
$select_friedship_requersts = mysql_query("SELECT * FROM  friendship WHERE secondid = {$_SESSION['userid']} AND confired = 0");
$open_friendship_request = mysql_num_rows($select_friedship_requersts);
if($open_friendship_request > 0)
{
	$friendship_request = '<a href="requerst_anwser.php">'. $open_friendship_request.' Freundschaftsanfragen</a> | ';	
}
$selectUserProfile = mysql_query("SELECT * FROM profile WHERE administraedFrom = {$_SESSION['userid']} AND type = 1");
$userProfile = mysql_fetch_assoc($selectUserProfile);
//Pinnwandausgaben
//Freunde auslesen
$selectAllFrinds = mysql_query("SELECT firstid, secondid FROM friendship WHERE confired = 1 AND (firstid = {$_SESSION['userid']} OR secondid = {$_SESSION['userid']})");
$frinds = array();
while($frindSelected = mysql_fetch_assoc($selectAllFrinds))
{
	if($frindSelected['firstid'] == $_SESSION['userid'])
	{
		$frinds[] = $frindSelected['secondid'];	
	}
	elseif($frindSelected['secondid'] == $_SESSION['userid'])
	{
		$frinds[] = $frindSelected['firstid'];
	}
}
//Gefaellt mir Seiten
$selctLikePages = mysql_query("SELECT pageID FROM likes WHERE userID = {$_SESSION['userid']}");
while($likePage = mysql_fetch_assoc($selctLikePages))
{
	$frinds[] = $likePage['pageID'];	
}
//Verarbeitung der Pinnwand
$idsToSelect = implode(", ", $frinds);
$pwDataSelect = mysql_query("SELECT * FROM pinnwand WHERE userid IN ({$idsToSelect}) ORDER BY poston DESC");
//Nachrichten auslesen
$select_unread_messages = mysql_query("SELECT * FROM  messageService WHERE readIt = 0 AND toUser = {$_SESSION['userid']}");
$nachrichten = "Sie haben " .mysql_num_rows($select_unread_messages) ." neue Nachrichten";
?>
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"><form action="search.php" method="get" style="float:left;">
		<input type="search" name="s"/> <input type="submit" name="serach" value="   Suchen  "/>
        </form>
		<?php echo $friendship_request; ?><a href="profile.php?p=<?php echo $userProfile['id']; ?>">Mein Profil</a> <?php echo $nachrichten; ?></div>
        <p style="clear:both;"></p>
        <div id="content">
            <div id="navi">
            	<a href="create_page.php">Seite anlegen</a><br/>
            	<a href="newGroup.php">Neue Gruppe</a>
            </div>
            <div id="main-content">
            <form action="home.php" method="post">
            <input type="text" value="Dein Status" name="pinnwand" style="width:100%;" onFocus="if(this.value == 'Dein Status') this.value = ''" onBlur="if(this.value == '') this.value = 'Dein Status'"/>
            </form>
            <hr>
            <?php
			while($pwData = mysql_fetch_assoc($pwDataSelect))
			{
				if($pwData['userid'])
				if($pwData['userid'] == $pwData['postOnUserID'])
				{
					$userDataSelect = mysql_query("SELECT prename, lastname FROM user WHERE id = '{$pwData['userid']}'");
					$nameData = mysql_fetch_assoc($userDataSelect);
					echo "<a href='profile.php?p={$pwData['userid']}'>{$nameData['prename']} {$nameData['lastname']}</a><br>";
					echo $pwData['pwcontent'] ."<br><br>";
					//Datum formatieren
					$predateTime = explode(" ", $pwData['poston']);
					$predate = explode("-",  $predateTime[0]);
					$date = $predate[2] ."." .$predate[1] ."." .$predate[0];
					echo "Geposted am: " .$date ." um " .$predateTime[1] ."<hr>";
				}
				else
				{
					$userDataSelect = mysql_query("SELECT prename, lastname FROM user WHERE id = '{$pwData['userid']}'");
					$nameData = mysql_fetch_assoc($userDataSelect);
					$userDataSelect2 = mysql_query("SELECT prename, lastname FROM user WHERE id = '{$pwData['postOnUserID']}'");
					$nameData2 = mysql_fetch_assoc($userDataSelect2);
					echo "<a href='profile.php?p={$pwData['userid']}'>{$nameData['prename']} {$nameData['lastname']}</a> &rsaquo; <a href='profile.php?p={$pwData['postOnUserID']}'>{$nameData2['prename']} {$nameData2['lastname']}</a><br>";
					echo $pwData['pwcontent'] ."<br><br>";
					//Datum formatieren
					$predateTime = explode(" ", $pwData['poston']);
					$predate = explode("-",  $predateTime[0]);
					$date = $predate[2] ."." .$predate[1] ."." .$predate[0];
					echo "Geposted am: " .$date ." um " .$predateTime[1] ."<hr>";
				}
			}
			?>
            
            </div>
        </div>
    </div>
</body>    
</html>