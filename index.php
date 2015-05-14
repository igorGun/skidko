<?php
require_once(dirname(__FILE__) . '/app.php');

if(!isset($_GET['id']) && !isset($_GET['alias']) && cookie_group(NULL) != 1) {
	$group = Table::Fetch('category', 1, 'id');
	cookie_group($group);
}

if(!$INI['db']['host']) Utility::Redirect( WEB_ROOT . '/install.php' );

$request_uri = 'index';
$team = current_team($city['id']);
//$teamG = current_team($group['id']);

if (!isset($_COOKIE['popup']))
{
	$sPopup = 1;
	setcookie('popup', 1, 	time() + 365 * 86400, '/');
}
// print_r($_COOKIE);
if ($team) {
	$_GET['id'] = abs(intval($team['id']));
	die(require_once('view.php'));
}

include template('subscribe');
