<?php
ob_start();
require_once(dirname(__FILE__) . '/app.php');
   /**
    * обновление фида только в 22:00 и 0:50
    */
      if ((time() >= mktime(0,50,0)) && (time() < mktime(22,0,0))){
          echo 'между 1:50 и 22';
          $updatetime = mktime(0,50,0,date('n'),(date('j')),date('Y'));
      }else{
          echo 'между 22 и 1:50';
          $offsetDay = ( ( time() < mktime(0,50,0) ) && ( time() > mktime(0,0,0) ) ) ? 1 : 0 ;
          $updatetime = mktime(22,0,0,date('n'),(date('j')-$offsetDay),date('Y'));
      }

$city = Table::Fetch('category', $team['city_id']);

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

	$dateend = strtotime(date('Y-m-d'));
	$city_id = $city['id'];
	$result = DB::Query("SELECT * FROM `team` WHERE (`end_time`>'$dateend') AND (`city_id` <2) AND ( ( `create_time` < $updatetime ) OR (`create_time` is null ) ) AND(`begin_time` < $now) ORDER BY `id` DESC");
	$ct = DB::Query("SELECT `name` FROM `category` WHERE (`zone`='city') ORDER BY `id` ASC");             //фильтр только по киеву и "всем городам"
	while ($id = mysql_fetch_assoc($ct)) $city1[] = $id['name'];
		
		
		
		
		
// XML
ob_end_clean();
header("Content-Type: application/xml; charset=utf-8");

echo "<?xml version='1.0' encoding='utf-8'?>\n";
?>
<discounts>
	<operator>
		<name>Скидкоман</name>
		<url>http://skidkoman.com.ua</url>
		<logo>http://skidkoman.com.ua/static/theme/green/css/i/site_logo.png</logo>
        <logo264>http://skidkoman.com.ua/img/264_93.jpg</logo264>
        <logo88>http://skidkoman.com.ua/img/88_31.jpg</logo88>
        <logo16>http://skidkoman.com.ua/img/favicon4.gif</logo16>
	</operator>
	<offers>
	
<?php	while ($team = mysql_fetch_assoc($result))
	{                     
		
//		print_r($team);
		if ($team['city_id']!=0)
		{
		?>
		<offer>
			<id><?=$team["id"];?></id>
			<name><?=$team["title"];?></name>
			<url>http://skidkoman.com.ua/team.php?id=<?=$team["id"]?></url>
			<description><?=$team["summary"];?></description>
			<region><?
				$city=Table::Fetch('category', $team['city_id']);
				echo $city["name"];
			?></region>
			
			<beginsell><?=date("Y-m-d\TH:i:s",$team["begin_time"]);?></beginsell>
			<endsell><?=date("Y-m-d\TH:i:s",$team["end_time"]);?></endsell>
			<beginvalid><?=date("Y-m-d\TH:i:s",$team["end_time"]);?></beginvalid>
			<endvalid><?=date("Y-m-d\TH:i:s",$team["expire_time"]);?></endvalid>
            <picture><?php if(1==preg_match('/http:/',$team['image']))echo $team['image']; else echo 'http://skidkoman.com.ua/static/'.$team["image"]; ?></picture>
			<price><?=$team["market_price"];?></price>
			<discount><?=$team["percentage"];?></discount>
			<discountprice><?=$team["team_price"];?></discountprice>
			<pricecoupon><?=$team["team_comission"];?></pricecoupon>
<?php
				$partner = Table::Fetch('partner', $team['partner_id']);
				//print_r($partner);
			?>
			<supplier>
				<name><?=$partner["title"];?></name>
				<url><?=$partner["homepage"];?></url>
				<tel><?php if($partner["phone"]) echo $partner["phone"]; else echo $partner["mobile"]?></tel>
				<addresses>
					<address>
						<name><?=$partner["location"];?></name>
					</address>
				</addresses>
			</supplier>
		</offer>
<?php 
		}
		else
		foreach($city1 as $a)
		{
            if ($a != 'Киев')
            continue;
			?>
			<offer>
				<id><?=$team["id"];?></id>
				<name><?=$team["title"];?></name>
				<url>http://skidkoman.com.ua/team.php?id=<?=$team["id"]?></url>
				<description><?=$team["summary"];?></description>
				<region><?=$a;?></region>
				
				<beginsell><?=date("Y-m-d\TH:i:s",$team["begin_time"]);?></beginsell>
				<endsell><?=date("Y-m-d\TH:i:s",$team["end_time"]);?></endsell>
				<beginvalid><?=date("Y-m-d\TH:i:s",$team["end_time"]);?></beginvalid>
				<endvalid><?=date("Y-m-d\TH:i:s",$team["expire_time"]);?></endvalid>
                <picture><?php if(1==preg_match('/http:/',$team['image']))echo $team['image']; else echo 'http://skidkoman.com.ua/static/'.$team["image"]; ?></picture>
				<price><?=$team["market_price"];?></price>
				<discount><?=$team["percentage"];?></discount>
				<discountprice><?=$team["team_price"];?></discountprice>
				<pricecoupon><?=$team["team_comission"];?></pricecoupon>
	<?php
					$partner = Table::Fetch('partner', $team['partner_id']);
					//print_r($partner);
				?>
				<supplier>
					<name><?=$partner["title"];?></name>
					<url><?=$partner["homepage"];?></url>
					<tel><?php if($partner["phone"]) echo $partner["phone"]; else echo $partner["mobile"]?></tel>
					<addresses>
						<address>
							<name><?=$partner["location"];?></name>
						</address>
					</addresses>
				</supplier>
			</offer>
	<?php 
		}
	}
?>
	</offers>
</discounts>

