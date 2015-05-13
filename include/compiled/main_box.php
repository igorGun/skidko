<div class="title_cart">
    <?=$team['title'];?>
</div>


<div class="row_cart">
	<div class="row_cart_img">
    		<ul id="portfolio">
			<li><img src="<?php if(1==preg_match('/http:/',$team['image']))echo $team['image']; else echo '/static/'.$team["image"]; ?>" alt="<?=$team['title']; ?>" /></li>
			<? if ($team['image1'] !='') { ?><li><img src="<?php if(1==preg_match('/http:/',$team['image1']))echo $team['image1']; else echo '/static/'.$team["image1"]; ?>" alt="<?php echo $team['title']; ?>" /></li><? } ?>
			<? if ($team['image2'] !='') { ?><li><img src="<?php if(1==preg_match('/http:/',$team['image2']))echo $team['image2']; else echo '/static/'.$team["image2"]; ?>" alt="<?php echo $team['title']; ?>"/></li><? } ?>
		</ul>
    </div>
    <div class="row_cart_right">
    	<?php if($login_user){?>
            <a class="knopka_cart_ok <?php if(strlen($team['btn_address'])>3) echo '"'; else echo 'modal" onclick="var event = arguments[0] || window.event;showBuyModal(event, this);return false'; ?>" href="<?php if(strlen($team['btn_address'])>3) echo $team['btn_address']; else echo '/team/buy.php?id='.$team['id']; ?>"><?=(moneyit($team['team_comission'])!=0?'Купить':'Получить')?></a>
        <?php } else { ?>
        <div id='basic-modal'>
    	    <a class="knopka_cart_ok basic <?php if(strlen($team['btn_address'])>3) echo '"'; else echo 'modal" onclick="var event = arguments[0] || window.event;showBuyModal(event, this);return false'; ?>" href="<?php if(strlen($team['btn_address'])>3) echo $team['btn_address']; else echo '/team/buy.php?id='.$team['id']; ?>"><?=(moneyit($team['team_comission'])!=0?'Купить':'Получить')?></a>
        </div>
		<?php } ?>
            <div class="row_cart_right_text">
            	<?php if($team['close_time']){?>
                <div class="cart_right_time">
                    Акция завершена <?=date('d.m.Y', $team['close_time'])?>
                </div>
                <div class="cart_right_kalendar">
                    Действительно до <?=date("d.m.Y", $team['expire_time'])?>
                </div>
                <? }else{ ?>
                <div class="cart_right_time">            
                    Осталось <span class="date" rel="<?php echo ($team['end_time']); ?>"><?php countdown($team['end_time']); ?></span>
                </div>
                <div class="cart_right_kalendar">
                    Действительно до <?=date("d.m.Y", $team['expire_time'])?>
                </div>
                <? } ?>
            	
                <div class="cart_right_kupon">
                	Получено купонов:
            <?php echo $all_days[$team['id']] ? $all_days[$team['id']]['q'] : 0; ?>
                </div>
                
                <div class="cart_right_txt">
                			<?php echo stripslashes($partner['title']); ?><br />
													  
							<?php echo $partner['location']; ?><br />
							<? if ($partner['metro']!=''):?><?php echo $partner['metro']; ?><br /><? endif;?>
							<?php echo $partner['phone']; ?><br />
							<?php if($partner['show_another'] == 1) $partner['another_site'];?>
							<a href="<?php if($partner['show_another'] == 1) {echo $partner['another_site'];} else {echo $partner['homepage'];} ?>" target="_blank"><?php echo domainit($partner['homepage']); ?></a><br />
							
                </div>
                <div class="cart_right_soc">
                    <div class="cart_right_soc_left">
                    Рассказать друзьям:
                    </div>
                    <div class="cart_right_soc_right">
              
                    
                     <script type="text/javascript"><!--
				document.write(VK.Share.button({url: "http://skidkoman.com.ua/<?php echo $team['id'].'_'.$team['alias']; ?>"},{type: "custom", text: "<img src=\"static/theme/green/css/images/vk_card.png\" />"}));
				--></script>
                    
                    <a href="#"><img src="static/theme/green/css/images/od_card.png"/></a>
                    <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
                    <a href="http://www.facebook.com/share.php?u=skidkoman.com.ua/<?php echo $team['id'].'_'.$team['alias']; ?>" onclick="return fbs_click()" target="_blank"><img src="static/theme/green/css/images/fb_card.png"/></a>
                    <a href="http://twitter.com/share?url=http://skidkoman.com.ua/<?php echo $team['id'].'_'.$team['alias']; ?>&text=<?echo urlencode($team['title'])?>" target="_blank"><img src="static/theme/green/css/images/tw_card.png"/></a>
                    </div>
                    <div class="clear"></div>
                 </div>
    </div>
</div>
</div>
<div id="openModal" class="modalDialog">
        <div>
            <a href="#close" title="Закрыть" class="close"></a>
            <h2>Получите купон</h2>
            <p>Вы можете получить до 10 купонов по данному предложению.</p>
            <div class="bg_grey">
            
                <div class="bg_grey_left modaltext">
                Скидка 5000 гривен на любой из курсов изучения английского языка в сети школ Speak Up!
                </div>
                
                <div class="bg_grey_right">
                        <form action="" method="post">
                    <div class="number">
                        <span class="minus"></span>
                        <input type="text" name="quantity" value="1" style="
                            text-align: center;
                            width: 40px;
                            background: none;
                            border: none;
                            font-weight: bold;
                            display: inline-block;
                            font-size: 20px;
                        ">
                        <span class="plus"></span>
                    </div>
                        </form>
                    
                </div>
                
                <div style="clear:both;"></div>
                
             </div>
             
             <a href="#openModal2" class="knopka_pol_kup get">ПОЛУЧИТЬ КУПОН</a>
        </div>
    </div>

    
    
    <div id="openModal2" class="modalDialog">
        <div>
            <a href="#close" title="Закрыть" class="close"></a>
            <br /><br /><br />
            <h2>Поздравляем, вы получили купон!</h2>
            <p>Купон доступен в  Личном  кабинете</p>
            
             
             <a href="/coupon/index.php" class="knopka_pol_kup">ПЕРЕЙТИ В ЛИЧНЫЙ КАБИНЕТ</a>
        </div>
    </div>
<div class="clear"></div>
