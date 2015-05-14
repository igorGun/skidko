<?php
require_once("transliteration.php");
$host = "localhost";
$user = "skidkoman_user";
$pass = "wG8Z8NqO";
$bd_name="skidkoman_db";

   
$link = mysqli_connect($host,$user,$pass,$bd_name);
mysqli_query($link, "SET NAMES 'utf8'" );
$res = mysqli_query($link, "SELECT id,title FROM team" );



while($row = mysqli_fetch_assoc($res)) {
  	$transedText=strtolower(get_seo_keyword(trim($row['title'])));
  	$newId=$row['id'];
  	mysqli_query($link, "UPDATE team 
    SET alias='$transedText' WHERE id='$newId'");
}

  
mysqli_close($link);
?>