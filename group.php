<?php
require_once(dirname(__FILE__) . '/app.php');

$idg = abs(intval($_GET['idg']));
$idt = abs(intval($_GET['idt']));


 
/*$host = "localhost";
$user = "skidkoman_user";
$pass = "wG8Z8NqO";
$bd_name='skidkoman_db';
   
    $link = mysqli_connect($host,$user,$pass,$bd_name);
    $res = mysqli_query($link, "SELECT id,ename FROM `category`WHERE ename='$alias'" );
   // $res =DB::GetQueryResult('SELECT id,ename FROM `category`WHERE ename="$alias"');
   // $res = DB::Query('SELECT id,ename FROM `category`WHERE ename="$alias" ');

while($row = mysqli_fetch_assoc($res)) {
    print_r($row);

    if ($alias==$row['ename']){
        $idg=$row['id'];
    }
    print_r($idg);
}*/
 $res =DB::Query("SELECT `id` FROM `category` WHERE `ename`='{$_GET['alias']}'");
while($row = mysqli_fetch_assoc($res)) {
    print_r($row);

    // if ($alias==$row['ename']){
        $idg=$row['id'];
    }


($currefer = strval($_GET['refer'])) || ($currefer = strval($_GET['r']));
if ($idg!='none') {
    $group = Table::Fetch('category', $idg, 'id');
   

    if ($group) { 
        cookie_group($group);
        $currefer = udecode($currefer);
//        if ($currefer) {
//            Utility::Redirect($currefer);
        } else    if ( $_SERVER['HTTP_REFERER'] ) {
            if (!preg_match('#'.$_SERVER['HTTP_HOST'].'#', $_SERVER['HTTP_REFERER'])) {
                // Utility::Redirect( WEB_ROOT . '/index.php');
            }
            if (preg_match('#/group#', $_SERVER['HTTP_REFERER'])) {
                // Utility::Redirect(WEB_ROOT .'/index.php');
            }
//            Utility::Redirect($_SERVER['HTTP_REFERER']);
        }
       // Utility::Redirect(WEB_ROOT .'/index.php');//редирект
        if ($idg===1) {
            Utility::Redirect(WEB_ROOT .'/index.php');//редирект
        }else{
            include template('viewall');
        }
    }

if ($idt!='none') {
    if ($idt) { 
        cookie_type($idt);
        $currefer = udecode($currefer);
//        if ($currefer) {
//            Utility::Redirect($currefer);
       /* } else */   if ( $_SERVER['HTTP_REFERER'] ) {
            if (!preg_match('#'.$_SERVER['HTTP_HOST'].'#', $_SERVER['HTTP_REFERER'])) {
                Utility::Redirect( WEB_ROOT . '/index.php');
            }
            if (preg_match('#/group#', $_SERVER['HTTP_REFERER'])) {
                Utility::Redirect(WEB_ROOT .'/index.php');
            }
//            Utility::Redirect($_SERVER['HTTP_REFERER']);
        }
        Utility::Redirect(WEB_ROOT .'/index.php');
    }
}

$cities = DB::LimitQuery('category', array(
    'condition' => array( 'zone' => 'city') ,
));
$cities = Utility::AssColumn($cities, 'letter', 'ename');
//include template('city');

