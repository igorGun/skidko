<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php //id=" echo $INI['sn']['sn']; ?>>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title><?php if($team['title']!="") echo $team['title']; else echo "Скидкоман - сервис коллективных скидок" ?></title>
    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?22"></script>
    <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script> 
    <meta name="Description" content="Лучшие предложения в городе <?php echo $city['name']; ?>" />
    <meta name="keywords" content="скидки, купоны, отдых, развлечения, кинотеатр, боулинг, ресторан, картинг, пейнтбол, бар, бассейн, салон красоты, солярий, фитнес клуб, суши, пицца, пиццерия, каток, ночной клуб" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

    <meta property="og:url" content="http://skidkoman.com.ua<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
    <?php if(strpos($_SERVER["SCRIPT_NAME"], '/team.php') !== false) { ?>
<meta property="og:image" content="<?php if(1==preg_match('/http:/',$team['image']))echo $team['image']; else echo 'http://skidkoman.com.ua/static/'.$team["image"]; ?>"/>
<?php } 


?> 
    <link href="<?php echo $INI['system']['wwwprefix']; ?>/feed.php?ename=<?php echo $city['ename']; ?>" rel="alternate" title="Subscribe" type="application/rss+xml" />
    <link rel="shortcut icon" href="/static/icon/favicon.ico" />
    <link rel="stylesheet" href="/static/css/index.css" type="text/css" media="screen" charset="utf-8" />

	<link rel="stylesheet" href="scrollup.css" type="text/css" media="screen">
	
	<script src="scrollup.js" type="text/javascript"></script>
    <!-- Contact Form CSS files -->
<link type='text/css' href='/css/basic.css' rel='stylesheet' media='screen' />

<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
<link type='text/css' href='http://skidkoman.com.ua/css/basic_ie.css' rel='stylesheet' media='screen' />
<![endif]-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script type="text/javascript">
        var browser = navigator.appName;

        /*$(document).ready(function(){
            if(browser == "Microsoft Internet Explorer"){
                $("#style").attr("href","/static/css/allie.css");
            }
        });*/
        </script>
    <script type="text/javascript">var WEB_ROOT = '<?php echo WEB_ROOT; ?>';</script>
    <script type="text/javascript">var LOGINUID= <?php echo abs(intval($login_user_id)); ?>;</script>
    <script src="/static/jssrc/index.js" type="text/javascript"></script>
    <script src="/static/jssrc/script.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/js/jquery.innerfade.js"></script>
<script type="text/javascript">
       $(document).ready(
                function(){            
                    $('ul#portfolio').innerfade({
                        speed: 1000,
                        timeout: 5000,
                        type: 'sequence',
                        containerheight: '220px'
                    });
            });
      </script>

<link rel="stylesheet" href="/static/theme/green/css/style.css"" type="text/css" media="screen" charset="utf-8" />
</head>
<body>

