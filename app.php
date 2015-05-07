<?php
require_once(dirname(__FILE__). '/include/application.php');
include_once(dirname(__FILE__). '/starfish/StarFishAPI.php');

/* process currefer*/
$currefer = uencode(strval($_SERVER['REQUEST_URI']));

/* session,cache,configure,webroot register */
Session::Init();
$INI = ZSystem::GetINI();
$AJAX = ('XMLHttpRequest' == @$_SERVER['HTTP_X_REQUESTED_WITH']);
if (false==$AJAX) { 
    header('Content-Type: text/html; charset=UTF-8;'); 
} else {
    header("Cache-Control: no-store, no-cache, must-revalidate");
}


if(isset($_GET['alias'])) {
    $res = DB::Query("SELECT `id` FROM `category` WHERE `ename`='{$_GET['alias']}'");
    $row = mysql_fetch_assoc($res);
    $_GET['idg'] = $row['id'];
}
/* end */

/* biz logic */
$currency = $INI['system']['currency'];
$login_user_id = ZLogin::GetLoginId();
$login_user = Table::Fetch('user', $login_user_id);
$city = cookie_city(null);
$group = cookie_group(null);
$ptype = cookie_type(null);
if ($ptype=='') $ptype=1;
$hotcities = Table::Fetch('category', $INI['hotcity']);


$cities_list_r = DB::Query("SELECT `id` , `name`,`ename`
                                 FROM   `category`
                                 WHERE  (`zone` =   'city')/* AND `id` NOT IN ('43','27')*/
                                 ORDER BY 'id' ASC
                                 ");
$cities_list = array();
while ($res = mysql_fetch_assoc($cities_list_r)){
	$cities_list[] = $res;
}
//print_r($cities_list);

/* not allow access app.php */
if($_SERVER['SCRIPT_FILENAME']==__FILE__){
	Utility::Redirect( WEB_ROOT . '/index.php');
}
/* end */

/* loginza */

if (isset($_POST['token']))
{
	print_r($_POST);
	$json = file_get_contents('http://loginza.ru/api/authinfo?token='.$_POST['token']);
	$data = json_decode($json);
	print_r($data);
}

/* loginza */