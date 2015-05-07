<?php include template("manage_header");?>

<div id="content-wrap">  <!--content start-->
  <div id="content">
    <div id="sidebar" >  <!-- left blck start-->
      <div class="sep"></div>
      <div class="sidebox">
       <ul class="sidemenu"><?php echo mcurrent_coupon('consume'); ?></ul>
      </div>
        
	</div>    <!-- left block end-->
    
    <div id="main"> 
      <div class="box">
                    <h2>Использованные <?php echo $INI['system']['couponname']; ?>ы</h2>
		
                <div id="list">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="100">Код</th><th width="440">предложение</th><th width="180">Имя</th><th width="140">Дата использования</th></tr>
					<?php if(is_array($coupons)){foreach($coupons AS $index=>$one) { ?>
					<tr <?php echo $index%2?'row-b':'class="row-a"'; ?> id="order-list-id-<?php echo $one['id']; ?>">
						<td><?php echo $one['id']; ?></td>
						<td><a class="deal-title" href="/<?php echo $one['team_id'].'_'.$teams[$one['team_id']]['alias']; ?>" target="_blank"><?php echo $teams[$one['team_id']]['title']; ?></a></td>
						<td nowrap><?php echo $users[$one['user_id']]['email']; ?><br/><?php echo $users[$one['user_id']]['username']; ?></td>
						<td nowrap><?php echo date('Y-m-d',$one['consume_time']); ?></td>
					</tr>
					<?php }}?>
					<tr><td colspan="5"><div id="no"><?php echo $pagestring; ?></div></tr>
                    </table>
				</div>
            </div>

        </div>
    </div>
</div>

<?php include template("manage_footer");?>
