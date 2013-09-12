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
if(isset($_GET['a']))
{
	$a = mysql_real_escape_string($_GET['a']);
	$ismyrequest = mysql_query("SELECT * FROM friendship WHERE secondid = {$_SESSION['userid']} AND confired = 0 AND id = {$a}");
	if(mysql_num_rows($ismyrequest) != 0)
	{
		$update = mysql_query("UPDATE friendship SET confired = 1 WHERE id = {$a}");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/requerst_anwser.php");
		exit;
	}
	else
	{
		$update = mysql_query("UPDATE friendship SET confired = 1 WHERE id = {$a}");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/requerst_anwser.php");
		exit;
	}
}
if(isset($_GET['d']))
{
	$d = mysql_real_escape_string($_GET['d']);
	$ismyrequest = mysql_query("SELECT * FROM friendship WHERE secondid = {$_SESSION['userid']} AND confired = 0 AND id = {$d}");
	if(mysql_num_rows($ismyrequest) != 0)
	{
		$update = mysql_query("DELETE FROM friendship WHERE id = {$d}");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/requerst_anwser.php");
		exit;
	}
	else
	{
		$update = mysql_query("UPDATE friendship SET confired = 1 WHERE id = {$a}");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/requerst_anwser.php");
		exit;
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
            <h2>Freundschaftsanfragen</h2>
            <?php
			$select_friedship_requersts = mysql_query("SELECT * FROM  friendship WHERE secondid = {$_SESSION['userid']} AND confired = 0");
			while($row = mysql_fetch_assoc($select_friedship_requersts))
			{
					$selct_user_info = mysql_query("SELECT * FROM user WHERE id = {$row['firstid']}");
					$userdata = mysql_fetch_assoc($selct_user_info);
					echo "<a href='requerst_anwser.php?a={$row['id']}'>{$userdata['prename']} {$userdata['lastname']} - Best&auml;tigen </a> | <a href='requerst_anwser.php?d={$row['id']}'>L&ouml;schen</a>";				
			}
			?>
            </div>
        </div>
    </div>
</body>    
</html>