<?php include template("manage_header");?>

<div id="content-wrap">  <!--content start-->
  <div id="content">
    <div id="sidebar" >  <!-- left blck start-->
      <div class="sidebox">
       <ul class="sidemenu"><?php echo mcurrent_order('pay'); ?></ul></div>
	</div>
    <div id="main"> 
      <div class="box">
                    <h2>Оплаченные заказы</h2>
					<ul class="filter"><li><form method="get">Email: <input type="text" name="uemail" class="h-input" value="<?php echo htmlspecialchars($uemail); ?>" >&nbsp;No: <input type="text" name="team_id" class="h-input number" value="<?php echo $team_id; ?>" >&nbsp;<input type="submit" value="фильтр" class="formbutton"  style="padding:1px 6px;"/><form></li></ul>
				
                <div id="list">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="35">ID</th><th width="340">Предложение</th><th width="170">Потребитель</th><th width="30" nowrap>Количество</th><th width="50" nowrap>Итоги</th><th width="50" nowrap>Сумма</th><th width="40" nowrap>Способ оплаты</th><th width="50" nowrap>Действие</th></tr>
					<?php if(is_array($orders)){foreach($orders AS $index=>$one) { ?>
					<tr <?php echo $index%2?'row-b':'class="row-a"'; ?> id="order-list-id-<?php echo $one['id']; ?>"  style="background:#FFFFFF">
						<td><?php echo $one['id']; ?></td>
						<td><?php echo $one['team_id']; ?>&nbsp;(<a class="deal-title" href="/<?php echo $one['team_id'].'_'.$teams[$one['team_id']]['alias']; ?>" target="_blank"><?php echo $teams[$one['team_id']]['title']; ?></a>)</td>
						<td><a href="/ajax/manage.php?action=userview&id=<?php echo $one['user_id']; ?>" class="ajaxlink"><?php echo $users[$one['user_id']]['email']; ?><br/><?php echo $users[$one['user_id']]['username']; ?></a></td>
						<td><?php echo $one['quantity']; ?></td>
						<td><?php echo moneyit($one['origin']); ?><span class="money"><?php echo $currency; ?></span></td>
						<td><?php echo moneyit($one['credit']); ?><span class="money"><?php echo $currency; ?></span></td>
						<!--<td><?php echo moneyit($one['money']); ?><span class="money"><?php echo $currency; ?></span></td>
						<td><?php echo $option_delivery[$teams[$one['team_id']]['delivery']]; ?><?php echo $one['express_id']?'Y':''; ?></td>-->
						<td><?php echo $one['service']; ?></td>
						<td class="op" nowrap><a href="/ajax/manage.php?action=orderview&id=<?php echo $one['id']; ?>" class="ajaxlink">Подробности</a></td>
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
