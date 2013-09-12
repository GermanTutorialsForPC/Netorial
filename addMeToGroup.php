<?php
session_start();
require_once('config.php');
if(isset($_GET['g']))
{
	$p = mysql_real_escape_string($_GET['g']);
	$insert = mysql_query("INSERT INTO groupsRelation VALUES('','{$p}','{$_SESSION['userid']}')");
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/group.php?g={$p}");
	exit;
}
else
{
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: http://$host$uri/home.php");
	exit;
}
?>