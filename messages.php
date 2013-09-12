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
?>
<!--Nachricht Sensen-->
<?php
	if(isset($_POST['send']) && str_replace(" ", "", $_POST['messageText']) != "")
	{
		//Eintrag in die Datenbank
		//Variablen
		$message = 	mysql_real_escape_string($_POST['messageText']);
		$sentTo = mysql_real_escape_string($_GET['goesto']);
		$dateTime = date("Y-m-d H:i:s");
		$insertDate = mysql_query("INSERT INTO messageService VALUES('', {$_SESSION['userid']}, {$sentTo}, '{$message}', '{$dateTime}', 0)");
	}
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
		<?php echo $friendship_request; ?><a href="profile.php?p=<?php echo $userProfile['id']; ?>">Mein Profil</a></div>
        <p style="clear:both;"></p>
        <div id="content">
            <div id="navi">Nachrichten mit</div>
            <div id="main-content">
            <?php
			if(isset($_GET['goesto']))
			{ ?>
            <!--Alten Nachrichten-->
            <!--Eingabe für neue Nachricht-->
            <form name="sendMessageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>?goesto=<?php echo $_GET['goesto']; ?>" method="post">
            	<textarea name="messageText" style="width:100%; height:80px;"></textarea>
                <input type="submit" value="Senden" name="send"/>
            </form>
            <?php }
			elseif(isset($_GET['m']))
			{
				$mid = mysql_real_escape_string($_GET['m']);
				$selectMessges = mysql_query("SELECT * FROM messageService WHERE id = {$mid} AND (toUser = {$_SESSION['userid']} OR fromUser = {$_SESSION['userid']})");
				while($row = mysql_fetch_assoc($selectMessges))
				{
					$selctUser = mysql_query("SELECT prename, lastname FROM user WHERE id = '{$row['fromUser']}'");
					$nameData = mysql_fetch_assoc($selctUser);
					echo "<h2>{$nameData['prename']} {$nameData['lastname']}</h2>";
					echo $row['messageText'];
					if($row['readIt'] == 0)
					{
						$update = mysql_query("UPDATE messageService SET readIt = 1 WHERE id = {$mid}");
					}
				}
			}
			else
			{
				$selectMessges = mysql_query("SELECT * FROM messageService WHERE toUser = {$_SESSION['userid']}");	
				while($row = mysql_fetch_assoc($selectMessges))
				{
					if($row['readIt'] == 0)	
					{
						echo "<b>";	
					}
						$selctUser = mysql_query("SELECT prename, lastname FROM user WHERE id = '{$row['fromUser']}'");
						$nameData = mysql_fetch_assoc($selctUser);
						echo "<a href='messages.php?m={$row['id']}'>{$nameData['prename']} {$nameData['lastname']}</a>";
					if($row['readIt'] == 0)	
					{
						echo "</b>";	
					}
					echo "<br>";
				}
			}
			?>
            </div>
        </div>
    </div>
</body>    
</html>