<?php include template("header");?>



<div class="content_other">
 <!-- 
        <div class="sbox">
        <div class="sbox-content" style="display:none;">
            <h2>Счет</h2>
            <p>Баланс: <strong><?php echo moneyit($login_user['money']); ?><span class="money"><?php echo $currency; ?></span></strong></p>
            <p align="center"><a href="/credit/charge.php">
                <img src="/static/theme/green/css/i/button_flow.png" alt="Пополнение счета"></a></p> </div> 
        </div>
        --->
        
        
        <!-- <ul>
						<li class="label">Категория:  </li>
						<?php echo current_coupon_sub('index'); ?>
					</ul>-->
                    
	<div class="title">Мои <?php echo $INI['system']['couponname']; ?>ы</div>
    <?php echo current_account('/coupon/index.php'); ?>
    <div class="clear"></div>
    
    
    
    
    
    				<?php if($selector=='index'&&!$coupons){?>
					<div class="row">Нет <?php echo $INI['system']['couponname']; ?>ов</div>
					<?php }?>
                    
					<?php if(is_array($coupons) && count($coupons)>0){foreach($coupons AS $index=>$one) { ?>
						<div class="row">
							<img src="<?php if(1==preg_match('/http:/',$teams[$one['team_id']]['image']))echo $teams[$one['team_id']]['image']; else echo '/static/'.$teams[$one['team_id']]['image']; ?>" width="380" height="213"/>
                            <div class="row_txt">
                                <div class="row_txt_1">
                                    <a class="deal-title" href="/team.php?id=<?php echo $one['team_id']; ?>" target="_blank"><?php echo $teams[$one['team_id']]['title']; ?></a>
                                    <br /><br />
                                    <span>Код купона: <?php echo $one['id']; ?></span><br />
                                    <span>Срок действия: <?php echo date('d.m.Y', $one['expire_time']); ?></span>
                                </div>
                                
                                <div class="row_txt_2">
                                    
                                    <a href="/coupon/print.php?id=<?php echo $one['id']; ?>" target="_blank" class="knopka_rk">Распечатать купон</a>
                                	<? if ($one['sms']==0 && $teams[$one['team_id']]['sms']=='Y') {?><a href="/ajax/coupon.php?action=sms&id=<?php echo $one['id']; ?>" class="ajaxlink knopka_sms">Отправить код в СМС</a><? } ?>
                                </div>
							</div>
                            <div class="clear"></div>
						
					<?php }}
					else { ?> 
						<div class="row">
							<strong>Вы еще не покупали купоны.</strong>
						</div>
					<? } ?>
                    
                    
    
  
    
    <div id="no"><?php echo $pagestring; ?></div>
    <div class="clear"></div>
</div>   
</div>

</div>



<?php include template("footer");?>
