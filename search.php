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
<html>
<head>
    <link href="style.css" rel="Stylesheet" type="text/css" media="screen"></link>
</head>
<body>
    <div id="root">
        <div id="logo"></div>
        <div id="sub-navi"><form action="search.php" method="get">
		<input type="search" name="s"/> <input type="submit" name="serach" value="   Suchen  "/>
        </form>
		<?php echo $friendship_request; ?><a href="profile.php?p=<?php echo $userProfile['id']; ?>">Mein Profil</a></div>
        <div id="content">
            <div id="navi"><a href="creat_page.php">Seite anlegen</a></div>
            <div id="main-content">
         		<?php
					if(isset($_GET['s']))
					{
						$s = mysql_real_escape_string($_GET['s']);	
						$selectProfile = mysql_query("SELECT id, profileName FROM  profile WHERE profileName LIKE '%{$s}%'");
						while($resaults = mysql_fetch_assoc($selectProfile))
						{
							echo "<a href='profile.php?p={$resaults['id']}'>{$resaults['profileName']}</a><br>";	
						}
					}
				?>
            </div>
        </div>
    </div>
</body>    
</html>