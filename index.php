<?php
require_once(dirname(__FILE__) . '/app.php');

if(!$INI['db']['host']) Utility::Redirect( WEB_ROOT . '/install.php' );

$request_uri = 'index';
$team = current_team($city['id']);
//$teamG = current_team($group['id']);

if (!isset($_COOKIE['popup']))
{
	$sPopup = 1;
	setcookie('popup', 1, 	time() + 365 * 86400, '/');
}

if ($team) {
	$_GET['id'] = abs(intval($team['id']));
	die(require_once('view.php'));
}

include template('subscribe');
