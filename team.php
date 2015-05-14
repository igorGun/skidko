<?php
require_once(dirname(__FILE__) . '/app.php');
//header(Location: "/");
$id = abs(intval($_GET['id']));
if (!$id || !$team = Table::FetchForce('team', $id) ) {
	Utility::Redirect( WEB_ROOT . '/team/index.php');
}
if ($_SERVER["REQUEST_URI"]=="/team.php?id={$id}") {
	header('HTTP/1.1 301 Moved Permanently');
	header("Location: {$team['id']}_{$team['alias']}");
}elseif ($_SERVER["REQUEST_URI"]!="/{$team['id']}_{$team['alias']}") { 
        header( "HTTP/1.1 404 Not Found" );
        header('Location: /404.php');
    }
/* refer */
if (abs(intval($_GET['r']))) { 
	if($_rid) cookieset('_rid', abs(intval($_GET['r'])));
	Utility::Redirect( WEB_ROOT . "/team.php?id={$id}");
}

if ($team['city_id']!=0) $city = Table::Fetch('category', $team['city_id']);

$pagetitle = $team['title'];

$discount_price = $team['market_price'] - $team['team_price'];
$discount_rate = 100 - $team['team_price']/$team['market_price']*100;
$team_comission = $team['team_comission'];

$left = array();
$now = time();
$diff_time = $left_time = $team['end_time']-$now;

$left_day = floor($diff_time/86400);
$left_time = $left_time % 86400;
$left_hour = floor($left_time/3600);
$left_time = $left_time % 3600;
$left_minute = floor($left_time/60);
$left_time = $left_time % 60;

/* progress bar size */
$bar_size = ceil(190*($team['now_number']/$team['min_number']));
$bar_offset = ceil(5*($team['now_number']/$team['min_number']));

$partner = Table::Fetch('partner', $team['partner_id']);

/* other teams */
if ( abs(intval($INI['system']['sideteam'])) ) {
	$oc = array( 
			'city_id' => $city['id'], 
			"id <> {$id}",
			"begin_time < {$now}",
			"end_time > {$now}",
			);
	$others = DB::LimitQuery('team', array(
				'condition' => $oc,
				'order' => 'ORDER BY id DESC',
				'size' => abs(intval($INI['system']['sideteam'])),
				));
}

$team['state'] = team_state($team);

/* your order */
if ($login_user_id && 0==$team['close_time']) {
	$order = DB::LimitQuery('order', array(
		'condition' => array(
			'team_id' => $id,
			'user_id' => $login_user_id,
			'state' => 'unpay',
		),
		'one' => true,
	));
}
$all_days = DB::GetQueryResult('SELECT team_id, SUM(quantity) as q FROM `order` where `team_id` = '.$team['id'].' GROUP BY team_id', false); 
$all_days = origCount($all_days);
/* end order */

include template('team_view');


function origCount($per_day) {
	foreach ($per_day as $key => $one_d) {
		unset($per_day[$key]);
		$one_d['number'] = intval($per_day[$one_d['team_id']]['number']) + intval($one_d['quantity']);
		$per_day[$one_d['team_id']] = $one_d;
	}
	return $per_day;
}
