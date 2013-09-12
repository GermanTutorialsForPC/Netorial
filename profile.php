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
if(isset($_GET['p']))
{
	require('config.php');
	$p = mysql_real_escape_string($_GET['p']);
	$selcte_profil_info = mysql_query("SELECT * FROM profile WHERE id = {$p}");
	if(mysql_num_rows($selcte_profil_info) != 0)
	{
		$user_data = mysql_fetch_assoc($selcte_profil_info);
		$selcte_user_info = mysql_query("SELECT * FROM user WHERE id = {$user_data['administraedFrom']}");
		$name = $user_data['profileName'];
		$profileInfo = str_replace("-_-_-_:-_:->|-#*##","",$user_data['profilInfos']);
		if($_SESSION['userid'] != $p && $user_data['type'] == 1)
		{
			
			
			//Wer ist mit mir befreundet und was gefaellt mir
			//Freunde auslesen
			$selectAllFrinds = mysql_query("SELECT firstid, secondid FROM friendship WHERE confired = 1 AND (firstid = {$p} OR secondid = {$p})");
			$frinds = array();
			while($frindSelected = mysql_fetch_assoc($selectAllFrinds))
			{
				if($frindSelected['firstid'] == $p)
				{
					$frinds[] = $frindSelected['secondid'];	
				}
				elseif($frindSelected['secondid'] == $p)
				{
					$frinds[] = $frindSelected['firstid'];
				}
			}
			$idsToSelect = implode(", ", $frinds);
			$FrindsSelect2 = mysql_query("SELECT id, profileName FROM profile WHERE type = 1 AND id IN ({$idsToSelect})");
			
				while($frindes = mysql_fetch_assoc($FrindsSelect2))
				{
              		$ausgabe .=  "<a href='profile.php?p={$frindes['id']}'>{$frindes['profileName']}</a><br>";
				}
			
			
			//Profil gefaellt...
			$selctLikes = mysql_query("SELECT pageID FROM likes WHERE userID = {$p}");
			$userLikes = "<h3>Gef&auml;llt mir</h3>";
			while($like = mysql_fetch_assoc($selctLikes))
			{
					$likePageInfoSelect = mysql_query("SELECT id, profileName FROM profile WHERE id = {$like['pageID']}");
					$pageData = mysql_fetch_assoc($likePageInfoSelect);
					$userLikes .="<a href='profile.php?p={$pageData['id']}'>{$pageData['profileName']}</a><br>";
			}
			
			
			$is_friendship = mysql_query("SELECT * FROM  friendship WHERE (firstid = {$_SESSION['userid']} OR secondid = {$_SESSION['userid']}) AND (firstid = {$user_data['administraedFrom']} OR secondid = {$user_data['administraedFrom']})");
			if(mysql_num_rows($is_friendship) != 0)
			{
				$isfriend = mysql_fetch_assoc($is_friendship);
				if($isfriend['confired'] == 1)
				{
					$frindlink = '<span style="float:right;"><a href="#">Ihr seid Freunde</a></span>';
				}
				else
				{
					$frindlink = '<span style="float:right;"><a href="#">Freundschaftsanfrage versendet</a></span>';
				}
			}
			else
			{
				$frindlink = '<span style="float:right;"><a href="frind.php?p=' .$p .'">Freunde werden</a></span>';
			}
			
			
		}
		elseif($_SESSION['userid'] != $p && $user_data['type'] == 2)
		{
			
			
			//Wenn gefaellt das
			$selectLikes = mysql_query("SELECT userID FROM likes WHERE pageID = {$p}");
			$likes = array();
			while($howLikes = mysql_fetch_assoc($selectLikes))
			{
				$likes[] = $howLikes['userID'];
			}
			$idsToSelect = implode(", ", $likes);
			$likeSelect = mysql_query("SELECT id, profileName FROM profile WHERE type = 1 AND id IN ({$idsToSelect})");
			while($frindes = mysql_fetch_assoc($likeSelect))
				{
              		$ausgabe .=  "<a href='profile.php?p={$frindes['id']}'>{$frindes['profileName']}</a><br>";
				}
			
			
			$is_like = mysql_query("SELECT * FROM  likes WHERE userID = {$_SESSION['userid']} AND pageID = {$p}");
			if(mysql_num_rows($is_like) != 0)
			{
					$frindlink = '<span style="float:right;"><a href="#">Dir gef&auml;llt das</a></span>';
			}
			else
			{
				$frindlink = '<span style="float:right;"><a href="like.php?p=' .$p .'">Gef&auml;llt mir</a></span>';
			}
		}
		else
		{
			$frindlink = '';	
		}
		
		
	}
	else
	{
		$name = "Diese Profil ist nicht vorhanden.";
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
            <h2><?php echo $name; ?></h2><?php echo $frindlink; ?>
            <form action="profile.php?p=<?php echo $p ?>" method="post">
            <input type="text" value="Poste an die Pinnwand" name="pinnwand" style="width:100%;" onFocus="if(this.value == 'Poste an die Pinnwand') this.value = ''" onBlur="if(this.value == '') this.value = 'Poste an die Pinnwand'"/>
            <input type="hidden" name="profileID" value="<?php echo $p ?>"/>
            </form>
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
                <div class="floatarea">
                <h3>Freund:</h3>
                <?php
                	echo $ausgabe;
				?>
                <h3>Profil</h3><span style="float:right"><a href="edit-profile.php?p=<?php echo $_GET['p'];?>">Profil bearbeiten</a></span>
                <?php echo $profileInfo; ?>
                <?php echo $userLikes; ?>
                </div>
                <p style="clear:both"></p>
            </div>
        </div>
    </div>
</body>    
</html>