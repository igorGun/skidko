<?php
require_once(dirname(dirname(dirname(__FILE__))) . '/app.php');

need_manager();
$now = time();
$condition = array(
	'system' => 'Y',
	"end_time > {$now}",
);
$count = Table::Count('team', $condition);
list($pagesize, $offset, $pagestring) = pagestring($count, 20);

$teams = DB::LimitQuery('team', array(
	'condition' => $condition,
	'order' => 'ORDER BY id DESC',
	'size' => $pagesize,
	'offset' => $offset,
));
$cities = Table::Fetch('category', Utility::GetColumn($teams, 'city_id'));
$groups = Table::Fetch('category', Utility::GetColumn($teams, 'group_id'));
$groups = Table::Fetch('category', Utility::GetColumn($teams, 'group_id'));
$partIds = getPartnrsId($teams, 'partner_id');
$teanIds = getPartnrsId($teams, 'id');
$partners = DB::GetDbRowById('partner', $partIds);

$daytime = strtotime(date('Y-m-d'));
$per_day = DB::GetQueryResult('SELECT team_id, quantity FROM `order` where `team_id` in ("'.implode('","',$teanIds) .'")  and DATE( FROM_UNIXTIME( create_time ) ) = DATE( NOW( ) ) ', false); 
$all_days = DB::GetQueryResult('SELECT team_id, SUM(quantity) as q FROM `order` where `team_id` in ("'.implode('","',$teanIds) .'") GROUP BY team_id', false); 
$per_day = origCount($per_day);
$all_days= origCount($all_days);

include_once 'metrika.php';
$metrikaPopData = comfortMetrika($metrikaPopular['data']);
//$yaViewsData = file_get_contents('http://api-metrika.yandex.ru/stat/content/popular.json?id=23996929');
//$yaViews = json_decode($yaViewsData, true);


//print_r($partners);

$selector = 'index';
include template('manage_team_index');


function getPartnrsId($teams, $key){
	$ids = array();
	foreach ($teams as $team) {
		if(!is_numeric($team[$key])) continue;

		$ids[$team[$key]] = true;
	}

	return array_keys($ids);	
}

function origCount($per_day) {
	foreach ($per_day as $key => $one_d) {
		unset($per_day[$key]);
		$one_d['number'] = intval($per_day[$one_d['team_id']]['number']) + intval($one_d['quantity']);
		$per_day[$one_d['team_id']] = $one_d;
	}
	return $per_day;
}

function comfortMetrika($data) {
	$pages = array();
	foreach ($data as $el) {
		if (strpos($el['url'], 'team.php') !== false) {
			$url = rtrim($el['url'], '/');
			$pages[$url] = isset($pages[$url])? $pages[$url] + $el['page_views'] : $el['page_views'];
		}		
	}
	return $pages;
}