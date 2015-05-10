<?php include template("manage_header");?>

<div id="content-wrap">  <!--content start-->
  <div id="content">
    <div id="sidebar" >  <!-- left blck start-->
      <div class="sidebox">
       <ul class="sidemenu"><?php echo mcurrent_order('index'); ?></ul></div>
	</div>
    <div id="main"> 
      <div class="box">
                    <h2>Заказы сейчас</h2>
					<ul class="filter"><li><form method="get">е-mail потребителей: <input type="text" name="uemail" class="h-input" value="<?php echo htmlspecialchars($uemail); ?>" >&nbsp;Код: <input type="text" name="team_id" class="h-input number" value="<?php echo $team_id; ?>" >&nbsp;<input type="submit" value="филтър" class="formbutton"  style="padding:1px 6px;"/><form></li></ul>
				
                <div id="list">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="40">ID</th><th width="340">Предложение</th><th width="180">Потребитель</th><th width="40" nowrap>Количество</th><th width="50" nowrap>Итоги</th><th width="50" nowrap>Сумма</th><th width="50" nowrap>Действие</th></tr>
					<?php if(is_array($orders)){foreach($orders AS $index=>$one) { ?>
					<tr <?php echo $index%2?'row-b':'class="row-a"'; ?> id="order-list-id-<?php echo $one['id']; ?>">
						<td><?php echo $one['id']; ?></td>
						<td><?php echo $one['team_id']; ?>&nbsp;(<a class="deal-title" href="/team.php?id=<?php echo $one['team_id']; ?>" target="_blank"><?php echo $teams[$one['team_id']]['title']; ?></a>)</td>
						<td><a href="/ajax/manage.php?action=userview&id=<?php echo $one['user_id']; ?>" class="ajaxlink"><?php echo $users[$one['user_id']]['email']; ?><br/><?php echo $users[$one['user_id']]['username']; ?></a></td>
						<td><?php echo $one['quantity']; ?></td>
						<td><?php echo moneyit($one['origin']); ?><span class="money"><?php echo $currency; ?></span></td>
						<td><?php echo moneyit($one['credit']); ?><span class="money"><?php echo $currency; ?></span></td>
						<!--<td><?php echo moneyit($one['money']); ?><span class="money"><?php echo $currency; ?></span></td>
						<td><?php echo $option_delivery[$teams[$one['team_id']]['delivery']]; ?><?php echo $one['express_id']?'Y':''; ?></td>-->
						<td class="op" nowrap><?php if($one['state']=='pay'){?><a href="/ajax/manage.php?action=orderview&id=<?php echo $one['id']; ?>" class="ajaxlink">Подробности</a><?php } else if($one['state']=='unpay') { ?><a href="/ajax/manage.php?action=ordercash&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Будет оплачена кэш? ">Кэш?</a><?php }?></td>
					</tr>
					<?php }}?>
					<tr><td colspan="9"><div id="no"><?php echo $pagestring; ?></div></tr>
                    </table>
				</div>
            </div>
            
        </div>
    </div>
</div>


<?php include template("manage_footer");?>
