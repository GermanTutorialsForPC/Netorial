<?php
session_start();
if(!isset($_SESSION['userid']))
{
            //Weiterleitung
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/index.php");
            exit;
}
if(isset($_POST['pinnwand']) && $_POST['pinnwand'] != "" && $_POST['pinnwand'] !="Poste an die Pinnwand")
{
	date_default_timezone_set("Europe/Berlin");
	$date = date("Y-m-d H:i:s");
	$pw = mysql_real_escape_string($_POST['pinnwand']);
	$uid = mysql_real_escape_string($_SESSION['userid']);
	$postOnID = mysql_real_escape_string($_POST['profileID']);
	require('config.php');
	$insert = mysql_query("INSERT INTO pinnwand VALUES('','{$pw}',{$uid},'{$postOnID}','{$date}')");
}
if(isset($_GET['g']))
{
	require('config.php');
	$g = mysql_real_escape_string($_GET['g']);
	$selcte_profil_info = mysql_query("SELECT * FROM groupData WHERE id = {$g}");
	if(mysql_num_rows($selcte_profil_info) != 0)
	{
		while($row = mysql_fetch_assoc($selcte_profil_info)) {
			$name = $row['groupName'];	
		}
		
	}
	else
	{
		$name = "Diese Gruppe ist nicht vorhanden.";
	}
}
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
            <h2><?php echo $name; ?></h2>
            <form action="profile.php?p=<?php echo $p ?>" method="post">
            <input type="text" value="Poste an die Pinnwand" name="pinnwand" style="width:100%;" onFocus="if(this.value == 'Poste an die Pinnwand') this.value = ''" onBlur="if(this.value == '') this.value = 'Poste an die Pinnwand'"/>
            <input type="hidden" name="profileID" value="<?php echo $p ?>"/>
            </form>
            <a href="addMeToGroup.php?g=<?php echo $_GET['g']; ?>">Mich hinzufügen</a>
            	<div class="floatarea">
                <?php
				//Pinwandausgabe
				$selctPWData = mysql_query("SELECT * FROM  pinnwand WHERE postOnUserID = {$p} ORDER BY poston DESC");
				while($pwData = mysql_fetch_assoc($selctPWData))
				{
					$selectPostFrom = mysql_query("SELECT * FROM user WHERE id = {$pwData['userid']}");
					$PostUserName = mysql_fetch_assoc($selectPostFrom);
					echo "<a href='profile.php?p=" .$PostUserName['id'] ."'>" .$PostUserName['prename'] ." " .$PostUserName['lastname'] ."</a><br>";
					echo $pwData['pwcontent'] ."<hr>";
				}
				?>
                </div>
               	
                <p style="clear:both"></p>
            </div>
        </div>
    </div>
</body>    
</html>