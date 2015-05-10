<?php include template("manage_header");?>

<div id="content-wrap">  <!--content start-->
  <div id="content">
    <div id="sidebar" >  <!-- left blck start-->
      <div class="sidebox">
       <ul class="sidemenu"><?php echo mcurrent_team($selector); $elURL = '';?></ul></div>
	</div>
    <div id="main"> 
      <div class="box">
				<?php if($selector=='failure'){?>
                    <h2>Неуспешные</h2>
				<?php } else if($selector=='success') { ?>
                    <h2>Успешные</h2>
				<?php } else { ?>
                    <h2>Текущие</h2>
				<?php }?>
				
                <div id="list">
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table">
					<tr><th width="30">ID</th><th width="400">Предложение</th><th width="80" nowrap>Город</th><th width="80">Дата</th><th width="40">Купонов всего</th><th width="50" nowrap>Партнер</th><th>Кол-во просмотров</th><th width="140">Действие</th><th>Соц. сети</th></tr>
					<?php if(is_array($teams)){foreach($teams AS $index=>$one) { ?>
					<?php $oldstate = $one['state']; ?>
					<?php $one['state'] = team_state($one); ?>
					<tr <?php echo $index%2?'row-b':'class="row-a"'; ?> id="team-list-id-<?php echo $one['id']; ?>">
						<td><?php echo $one['id'];?></a></td>

						<td><a class="deal-title" href="/<?php echo $one['id'].'_'.$one['alias']; ?>" target="_blank"><?php echo $one['title']; ?></a></td>
						<td nowrap><?php if ($one['city_id']==0) echo 'Все города'; echo $cities[$one['city_id']]['name']; ?><br/><?php echo $groups[$one['group_id']]['name']; ?></td>
						<td nowrap><?php echo date('Y-m-d',$one['begin_time']); ?><br/><?php echo date('Y-m-d',$one['end_time']); ?></td>
						<td nowrap><?php echo $all_days[$one['id']] ? $all_days[$one['id']]['q'] : 0; ?>/<?php echo $per_day[$one['id']] ? $per_day[$one['id']]['number'] : 0; ?></td>

						<td nowrap><span class="money"></span><?php echo $partners[$one['partner_id']]['username']; ?><span class="money"></span></td>
						<td><?php $elURL = 'http://skidkoman.com.ua/team.php?id=' . $one['id'];
						echo isset($metrikaPopData[$elURL])? $metrikaPopData[$elURL]: 0; ?></td>
						<td class="op" nowrap><a href="/ajax/manage.php?action=teamdetail&id=<?php echo $one['id']; ?>" class="ajaxlink">Подробности</a>&nbsp;&nbsp;&nbsp;<a href="/manage/team/edit.php?id=<?php echo $one['id']; ?>">Изменить</a>&nbsp;&nbsp;&nbsp;<a href="/ajax/manage.php?action=teamremove&id=<?php echo $one['id']; ?>" class="ajaxlink" ask="Удалить?" >Удалить</a><?php if(/*$one['close_time']&&*/in_array($one['state'],array('success','soldout'))){?>&nbsp;&nbsp;&nbsp;<a href="/manage/team/down.php?id=<?php echo $one['id']; ?>" target="_blank">Скачать</a><?php }?></td>
						<td nowrap><script type="text/javascript"><!--
				document.write(VK.Share.button({url: "http://skidkoman.com.ua/team.php?id=<?php echo $one['id']; ?>"},{type: "custom", text: "<img src=\"/static/theme/green/css/images/vk_card.png\" />"}));
				--></script>
                    
                    
                    <script>function fbs_click(it) {var $el = $(it).parents('tr').find('.deal-title'); u="http://skidkoman.com.ua" + $el.attr('href');t=$el.text();window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
                    <a href="http://www.facebook.com/share.php?u=skidkoman.com.ua/team.php?id=<?php echo $one['id']; ?>" onclick="return fbs_click(this)" target="_blank"><img src="/static/theme/green/css/images/fb_card.png"/></a></td>
					</tr>
					<?php }}?>
					<tr><td colspan="7"><div id="no"><?php echo $pagestring; ?></div></tr>
                    </table>
                    <?php /*print_r($metrikaPopular['data']);*/ ?>
				</div>
            </div>
            
        </div>
    </div>
</div>


<?php include template("manage_footer");?>
