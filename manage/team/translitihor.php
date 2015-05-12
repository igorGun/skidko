<?php
/*$str = 'Скидка 50 % на мастер-класс «Нестандартный подход к решению проблем» в Студии нестандартного мышления «Лабиринт»';
$str2 = 'Д--=\|/р~у`з)ь*&^:;(я, д?.><а@#,.!в$%#@@!№айт?е ж"и ть ]д[ру{}[жно';
echo translit($str2);
// your code goes here
 
 
function translit($to_url) {
 
 
    $url = transRus($to_url);    // Заменяем кириллицу согласно массиву замены
    $url = mb_strtolower($url);	      // В нижний регистр
 
    $url = preg_replace("/[^a-z0-9-_,\s]/i", "", $url);  // Удаляем лишние символы
    $url = preg_replace("/[,-]/ui", " ", $url);         // Заменяем на пробелы
    $url = preg_replace("/[\s]+/ui", "-", $url);         // Заменяем 1 и более пробелов на "-"	
	$url = trim($url, "-");
 
    return $url;
}
 
function transRus($str)
    {
        $tr = array(
            "А"=>"a",
            "Б"=>"b",
            "В"=>"v",
            "Г"=>"g",
            "Д"=>"d",
            "Е"=>"e",
            "Ё"=>"e",
            "Ж"=>"j",
            "З"=>"z",
            "И"=>"i",
            "Й"=>"y",
            "К"=>"k",
            "Л"=>"l",
            "М"=>"m",
            "Н"=>"n",
            "О"=>"o",
            "П"=>"p",
            "Р"=>"r",
            "С"=>"s",
            "Т"=>"t",
            "У"=>"u",
            "Ф"=>"f",
            "Х"=>"h",
            "Ц"=>"ts",
            "Ч"=>"ch",
            "Ш"=>"sh",
            "Щ"=>"sch",
            "Ъ"=>"",
            "Ы"=>"i",
            "Ь"=>"j",
            "Э"=>"e",
            "Ю"=>"yu",
            "Я"=>"ya",
            "а"=>"a",
            "б"=>"b",
            "в"=>"v",
            "г"=>"g",
            "д"=>"d",
            "е"=>"e",
            "ё"=>"e",
            "ж"=>"j",
            "з"=>"z",
            "и"=>"i",
            "й"=>"y",
            "к"=>"k",
            "л"=>"l",
            "м"=>"m",
            "н"=>"n",
            "о"=>"o",
            "п"=>"p",
            "р"=>"r",
            "с"=>"s",
            "т"=>"t",
            "у"=>"u",
            "ф"=>"f",
            "х"=>"h",
            "ц"=>"ts",
            "ч"=>"ch",
            "ш"=>"sh",
            "щ"=>"sch",
            "ъ"=>"y",
            "ы"=>"i",
            "ь"=>"j",
            "э"=>"e",
            "ю"=>"yu",
            "я"=>"ya",
        );
        return strtr($str,$tr);
    }*/
function get_seo_keyword($str)
{
    $tr = array(
        "А" => "a","Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", 
        "Ж" => "j", "З" => "z", "И" => "i", "Й" => "y", "К" => "k", "Л" => "l", 
        "М" => "m", "Н" => "n", "О" => "o","П" => "p","Р" => "r","С" => "s",
        "Т" => "t","У" => "u","Ф" => "f","Х" => "h","Ц" => "ts","Ч" => "ch",
        "Ш" => "sh","Щ" => "sch","Ъ" => "","Ы" => "yi","Ь" => "","Э" => "e",
        "Ю" => "yu","Я" => "ya","а" => "a","б" => "b","в" => "v","г" => "g",
        "д" => "d","е" => "e","ж" => "j","з" => "z","и" => "i","й" => "y",
        "к" => "k","л" => "l","м" => "m","н" => "n","о" => "o","п" => "p",
        "р" => "r","с" => "s","т" => "t","у" => "u","ф" => "f","х" => "h",
        "ц" => "ts","ч" => "ch","ш" => "sh","щ" => "sch","ъ" => "y","ы" => "yi",
        "ь" => "","э" => "e","ю" => "yu","я" => "ya"," " => "-","." => "",
        "/" => "-","\""=>""
    );
    $res = strtr($str, $tr);
 
    if (preg_match('/[^A-Za-z0-9_\-]/', $res)) {
        $res = preg_replace('/[^A-Za-z0-9_\-]/', '', $res);
    }
 	$res=preg_replace('/-+/','-',$res);

    return urlencode(strtolower($res));
}
//echo get_seo_keyword("Д--=\|/р~у`з)ь*&^:;+(я, д?.><а@#,.!в$%#@@!№айт?е ж\"и ть ]д[ру{}[жно");
?>