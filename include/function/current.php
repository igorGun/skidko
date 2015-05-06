<?php
function current_frontend() {          
	global $INI;
	$a = array(
			'/index.php'                            => 'Сегодня',
			'/team/index.php'                       => 'Прошедшие акции',
			'/help/tour.php'                        => 'Как это работает?',
//			'/subscribe.php'                        => 'Подпишитесь',
//			'/forum/city.php'                       => 'Форум',
           // $INI['system']['wwwprefix'].'/subscribe.php' => 'Интересно что дальше?',
	);
    
/*	if (abs(intval($INI['system']['forum']))) {
		unset($a['/subscribe.php']);
		$a['/forum/city.php'] = 'Форум';
	}*/
	$r = $_SERVER['REQUEST_URI'];
	if (preg_match('#/team#',$r)) $l = '/team/index.php';
	elseif (preg_match('#/help#',$r)) $l = '/help/tour.php';
//	elseif (preg_match('#/subscribe#',$r)) $l = '/subscribe.php';
//	elseif (preg_match('#/forum#',$r)) $l = '/forum/city.php';
	elseif (preg_match('#/order#',$r)) $l = '/order/index.php';
	elseif (preg_match('#/account#',$r)) $l = '/account/login.php';
    //elseif (preg_match('#/account#',$r)) $l = '/account/login.php';
//    elseif (preg_match('#/account#',$r)) $l = '/account/login.php';

	else $l = '/index.php';
	return current_link($l, $a);       // вызывает отключенную функцию
}       

function current_frontend1(){           //заменяет верхнюю функцию везде, кроме списка выбора городов
    global $INI;
    global $city;
    global $ptype;
    $now = time();
    $city_id = $city['id'];
    $a = array();
    $dateend = strtotime(date('Y-m-d'));
    $counter = DB::Query("SELECT COUNT(*) 
                              FROM `team` 
                              WHERE (`end_time` > '$dateend')
                                    AND (`city_id` = '$city_id' OR `city_id` =0)
                                    AND (`create_time` < $now)
                                    AND (`begin_time` < $now)
                                    ".($ptype==1?' ':($ptype==2?" AND (`team_comission`<>0) ":" AND (`team_comission`=0) "))." 
                              ORDER BY `id` ASC
                              ");
    list($tmp) = mysql_fetch_row($counter);
    $a['/group.php?idg=1']= array('Все акции' => $tmp);
    $groups_name_id = DB::Query("SELECT `id` , `name`, `ename`
                                 FROM   `category`
                                 WHERE  (`zone` =   'group')/* AND `id` NOT IN ('43','27')*/
                                 ORDER BY 'id' ASC
                                 ");

    while ($res = mysql_fetch_assoc($groups_name_id)){
    	//
        $group_id = $res['id'];
       //print_r($group_id);
        $dateend = strtotime(date('Y-m-d'));
        $counter = DB::Query("SELECT COUNT(*) 
                              FROM `team`
                              WHERE (`end_time` > '$dateend')
                                    AND (`city_id` = '$city_id' OR `city_id` =0)
                                    AND (`group_id` = '$group_id')
                                    AND (`create_time` < $now)
                                    AND (`begin_time` < $now)
                                    ".($ptype==1?' ':($ptype==2?" AND (`team_comission`<>0) ":" AND (`team_comission`=0) "))."
                              ORDER BY `id` ASC
                              ");
        //print_r($group_id);
        list($tmp) = mysql_fetch_row($counter);
        $k = /*$res['ename'].$res['id'];//изменено*/"/group.php?idg=".$res['id'];
        
        $v = $res['name'];
        if ($tmp > 0) $a[$k] = array($v => $tmp);

    }
    $r = $_SERVER['REQUEST_URI'];
    if (preg_match('#/team#',$r)) $l = '/team/index.php';
    elseif (preg_match('#/help#',$r)) $l = '/help/tour.php';
    elseif (preg_match('#/order#',$r)) $l = '/order/index.php';
    elseif (preg_match('#/account#',$r)) $l = '/account/login.php';
    else $l = '/index.php';
    return current_link1($l, $a);
}

function current_frontend2(){           //заменяет верхнюю функцию везде, кроме списка выбора городов
    global $INI;
    global $city;
    $now = time();
    $city_id = $city['id'];
    $a = array();
    $dateend = strtotime(date('Y-m-d'));
    $counter = DB::Query("SELECT COUNT(*) 
                              FROM `team` 
                              WHERE (`end_time` > '$dateend')
                                    AND (`city_id` = '$city_id' OR `city_id` =0)
                                    AND (`create_time` < $now)
                                    AND (`begin_time` < $now)
                              ORDER BY `id` ASC
                              ");
    list($tmp) = mysql_fetch_row($counter);
    $a['/group.php?idg=1']= array('Все акции' => '');
    $a['/group.php?idg=43']= array('Платные' => '');
    $a['/group.php?idg=27']= array('Бесплатные' => '');
    $l = '/index.php';
    return current_link1($l, $a);
}

function current_backend() {
    global $INI;
    $a = array(
            '/manage/misc/index.php' => 'Главная',
            '/manage/team/index.php' => 'Предложение',
            '/manage/order/index.php' => 'Заказы',
            '/manage/coupon/index.php' => $INI['system']['couponname'],
            '/manage/user/index.php' => 'Юзеры',
            '/manage/partner/index.php' => 'Партнеры',
            '/manage/market/index.php' => 'Бизнес',
            '/manage/category/index.php' => 'Категории',
            '/manage/syst/index.php' => 'Система',
            );
    $r = $_SERVER['REQUEST_URI'];
    if (preg_match('#/manage/(\w+)/#',$r, $m)) {
        $l = "/manage/{$m[1]}/index.php";
    } else $l = '/manage/misc/index.php';
    return current_link($l, $a);
}   

function current_biz() {
	global $INI;
	$a = array(
			'/biz/index.php' => 'Главная',
			'/biz/coupon.php' => 'Список ' . $INI['system']['couponname'] . 'ов',
			//'/biz/verifycode.php' => 'Проверка купонов',
			);
	$r = $_SERVER['REQUEST_URI'];
	if (preg_match('#/biz/coupon#',$r)) $l = '/biz/coupon.php';
	elseif (preg_match('#/biz/settings#',$r)) $l = '/biz/settings.php';
	elseif (preg_match('#/biz/verifycfode#',$r)) $l = '/biz/verifycode.php';
	else $l = '/biz/index.php';	
	return current_link($l, $a);
}

function current_forum($selector='city') {
	global $city;
	$a = array(
	        '/forum/city.php' => "{$city['name']}",
			'/forum/public.php' => 'Другие темы',
			'/forum/index.php' => 'Все темы',
			);
	if (!$city) unset($a['/forum/city.php']);
	$l = "/forum/{$selector}.php";
	return current_link($l, $a, true);
}

function current_city($cename, $citys) {
	$link = "/city.php?ename={$cename}";
	$links = array();
	foreach($citys AS $city) {
		$links["/city.php?ename={$city['ename']}"] = $city['name'];
	}
	return current_link($link, $links);
}

function current_coupon_sub($selector='index') {
	$selector = $selector ? $selector : 'index';
	$a = array(
		'/coupon/index.php' => 'Неиспользованные',
		
		'/coupon/consume.php' => 'Использованные',
		
		'/coupon/expire.php' => 'Истекшие',
	);
	$l = "/coupon/{$selector}.php";
	return current_link($l, $a);
}

function current_account($selector='/account/settings.php') {
	global $INI;
	$a = array(


		'/account/settings.php' => 'Личные данные',
	);
	return current_link($selector, $a, true);
}

function current_about($selector='us') {
	global $INI;
	$a = array(
	
		
		'/about/job.php' => 'Вакансии',
		'/about/privacy.php' => 'Конфиденциальность',
		'/about/terms.php' => 'Условия пользования',
	);
	$l = "/about/{$selector}.php";
	return current_link($l, $a, true);
}

function current_help($selector='faqs') {
	global $INI;
	$a = array(
		'/help/tour.php' => 'Как работает ' . $INI['system']['abbreviation'],
		'/help/faqs.php' => 'Вопросы и ответы',
		'/help/payment.php' => 'Оплата',
        '/help/team_about.php' => 'О нас',

	);
	$l = "/help/{$selector}.php";
	return current_link($l, $a, true);
}

function current_order_index($selector='index') {
	$selector = $selector ? $selector : 'index';
	$a = array(
		'/order/index.php?s=index' => 'Все',
		'/order/index.php?s=unpay' => 'Неоплаченные',
		'/order/index.php?s=pay' => 'Оплаченные',
	);
	$l = "/order/index.php?s={$selector}";
	return current_link($l, $a);
}

/**
* Возвращает готовое верхнее меню
* 
* @param String $link    URL, на какоторый осуществляется переход
* @param Array $links    Массив главного меню, ('ссылка' => название)
* @param boolean $span
*/
function current_link($link, $links, $span=false) {     

    global $city;
    $html = '';
    $span = $span ? '<span></span>' : '';
    $city_id = $city['id'];
    $now = time();
    foreach($links AS $l=>$n) {
        $add = '';
        if ($n=='Сегодня')
        {
            $dateend = strtotime(date('Y-m-d'));
            //$city_id = $city['id'];
            $result = DB::Query("SELECT count(*) FROM `team` WHERE (`end_time`>'$dateend') AND (`city_id` = '$city_id' OR `city_id` = '0')
                                    AND (`create_time` < $now)
                                    AND (`begin_time` < $now) ORDER BY `id` DESC");
            list($tmp) = mysql_fetch_row($result);
            $add = " ($tmp)";
        }
        if ($n=='Прошедшие акции')
        {
            $dateend = strtotime('now');
            //$city_id = $city['id'];
            $result = DB::Query("SELECT count(*) FROM `team` WHERE (`end_time`<'$dateend') AND (`city_id` = '$city_id' OR `city_id` = '0')
                                    AND (`create_time` < $now)
                                    AND (`begin_time` < $now) ORDER BY `id` DESC");
            list($tmp) = mysql_fetch_row($result);
            $add = " ($tmp)";
        }
        
        if (trim($l,'/')==trim($link,'/')) {
            $html .= "<li><a class=\"knopka_ld\" href=\"{$l}\">{$n}$add</a>{$span}</li>";
        }
        else $html .= "<li><a class=\"knopka_ld\" href=\"{$l}\">{$n}$add</a>{$span}</li>";
    }
    return $html;
}

/**
* Возвращает готовое верхнее меню
* 
* @param String $link    URL, на какоторый осуществляется переход
* @param Array $links    Массив главного меню, ('ссылка' => ('название' => 'количество') )
* @param boolean $span
*/
function current_link1($link, $links, $span=false) {  
	global $group;
    $global_group_id = $group['id'];
   
	$html = '';
	$span = $span ? '<span></span>' : '';
	foreach($links AS $l=>$n) {
        $group_id = intval(substr($l,-2));

      /* if ($l!="/group.php?idg=1"){
        	$l=substr($l, 0, -2);
        }*/
         
        //print_r($global_group_id);                    //получаем id группы. -2 - ограничивает количество групп 99 штуками
        if ($group_id==0) $group_id=1;
		$add = current($n);
		if ($global_group_id == $group_id){
			$html .= "<li id=\"current\"><a href=\"{$l}\" title=\"".key($n)."\">".key($n)."<sup>$add</sup></a>{$span}</li>";
		}
		else $html .= "<li><a href=\"{$l}\" title=\"".key($n)."\">".key($n)."<sup>$add</sup></a>{$span}</li>";
	}
	return $html;
}

/* manage current */
function mcurrent_misc($selector=null) {
	$a = array(
		'/manage/misc/index.php' => 'Главная',
		//'/manage/misc/ask.php' => 'Вопросы',
		'/manage/misc/feedback.php' => 'Обратная связь',
		'/manage/misc/subscribe.php' => 'Подпишитесь',
		'/manage/misc/invite.php' => 'Пригласи друга',
	);
	$l = "/manage/misc/{$selector}.php";
	return current_link($l,$a,true);
}

function mcurrent_misc_money($selector=null){
	$selector = $selector ? $selector : 'store';
	$a = array(
		'/manage/misc/money.php?s=store' => 'Offline деньги',
		'/manage/misc/money.php?s=charge' => 'Online деньги',
		'/manage/misc/money.php?s=withdraw' => 'Снятие денег',
		'/manage/misc/money.php?s=cash' => 'Кеш',
		'/manage/misc/money.php?s=refund' => 'Возвращение',
	);
	$l = "/manage/misc/money.php?s={$selector}";
	return current_link($l, $a);
}

function mcurrent_misc_invite($selector=null){
	$selector = $selector ? $selector : 'index';
	$a = array(
		'/manage/misc/invite.php?s=index' => 'Приглашение',
		'/manage/misc/invite.php?s=record' => 'Скидка',
	);
	$l = "/manage/misc/invite.php?s={$selector}";
	return current_link($l, $a);
}
function mcurrent_order($selector=null) {
	$a = array(
		'/manage/order/index.php' => 'Текущие',
		'/manage/order/pay.php' => 'Оплаченные',
		'/manage/order/unpay.php' => 'Неоплаченные',
	);
	$l = "/manage/order/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_user($selector=null) {
	$a = array(
		'/manage/user/index.php' => 'Пользователи',
		'/manage/user/manager.php' => 'Админ',
	);
	$l = "/manage/user/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_team($selector=null) {
	$a = array(
		'/manage/team/index.php' => 'Текущие',
		'/manage/team/success.php' => 'Успешные',
		'/manage/team/failure.php' => 'Неуспешные',
		'/manage/team/create.php' => 'Новое Предл.',
	);
	$l = "/manage/team/{$selector}.php";
	return current_link($l,$a,true);
}

function mcurrent_feedback($selector=null) {
	$a = array(
		'/manage/feedback/index.php' => 'Все',
	);
	$l = "/manage/feedback/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_coupon($selector=null) {
	$a = array(
		'/manage/coupon/index.php' => 'Неиспользованные',
		'/manage/coupon/consume.php' => 'Использованные',
		'/manage/coupon/expire.php' => 'Истекшие',
	);
	$l = "/manage/coupon/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_category($selector=null) {
	$zones = get_zones();
	$a = array();
	foreach( $zones AS $z=>$o ) {
		$a['/manage/category/index.php?zone='.$z] = $o;
	}
	$l = "/manage/category/index.php?zone={$selector}";
	return current_link($l,$a,true);
}
function mcurrent_partner($selector=null) {
	$a = array(
		'/manage/partner/index.php' => 'Список партнерах',
		'/manage/partner/create.php' => 'Новый партнер',
	);
	$l = "/manage/partner/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_market($selector=null) {
	$a = array(
		'/manage/market/index.php' => 'Выслать Email',
		'/manage/market/sms.php' => 'Групповой SMS',
		'/manage/market/down.php' => 'Скачать данные',
	);
	$l = "/manage/market/{$selector}.php";
	return current_link($l,$a,true);
}
function mcurrent_market_down($selector=null) {
	$a = array(
		'/manage/market/down.php' => 'Телефон',
		'/manage/market/downemail.php' => 'Email',
		'/manage/market/downorder.php' => 'Заказы',
		'/manage/market/downcoupon.php' => 'Купоны',
		'/manage/market/downuser.php' => 'Пользователи',
	);
	$l = "/manage/market/{$selector}.php";
	return current_link($l,$a,true);
}

function mcurrent_system($selector=null) {
	$a = array(
		'/manage/syst/index.php' => 'Основные',
		'/manage/syst/bulletin.php' => 'Бюллетень',
		'/manage/syst/pay.php' => 'Оплата',
		'/manage/syst/email.php' => 'Email',
		'/manage/syst/sms.php' => 'SMS',
		'/manage/syst/city.php' => 'Город',
		'/manage/syst/page.php' => 'Страница',
		'/manage/syst/cache.php' => 'Cache',
		'/manage/syst/skin.php' => 'Скин',
		'/manage/syst/template.php' => 'Темплейт',
	);
	$l = "/manage/syst/{$selector}.php";
	return current_link($l,$a,true);
}
