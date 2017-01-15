<?php function headdocs() {    ?>
<!DOCTYPE html>
	<html>

<meta http-equiv="X-UA-Compatible" content="IE=9" />

<!--
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
-->
    <head>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36629239-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

        <?php
         if(defined('CATNAME')) {
            $sitetitle = CATNAME;            
         }else{
            $sitetitle = 'Yummy Sushi - køge, hosomaki, futomaki, nigiri, inside-out...';
         }
        ?>
        <title><?php echo $sitetitle;?></title>
        <meta name="description" content="Vi er en ny sushi take away bar og vi hedder yummy sushi som laver den bedste kvalitiet råvarer alt inden for sushi verden. Vi har frokost tilbud, studie rabat og både små og store deluxe menuer til hygge fester og selskaber. Vi vil derfor se jer alle i vores lille hyggelig sted i Nørregade 44, køge." />

        <meta name="Keywords" content="sushi køge, sushi, inside-out, restaurant, take away, frokost, sushi i koge">
        <meta name="robots" content="noodp">
        <meta name="Author" content="Bamboo Solution, info@bamboo-solution.dk">
        <meta property="og:description" content="Vi er en ny sushi take away bar og vi hedder yummy sushi som laver den bedste kvalitiet råvarer alt inden for sushi verden. Vi har frokost tilbud, studie rabat og både små og store deluxe menuer til hygge fester og selskaber. Vi vil derfor se jer alle i vores lille hyggelig sted i Nørregade 44, køge. mkh Yummy Sushi personaler." />
        <meta property="og:image" content="http://www.yummysushi.dk/include/grafix/fish_blue.png">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="include/css/styles.css" />
        <![if !IE]>
        <style type="text/css">
        	.menu:hover .menu-description {
				opacity: 1;
				color: #fff;
				-moz-transition: opacity 100ms ease-in 0s;
				-webkit-transition: opacity 100ms ease-in 0s;
				-o-transition: opacity 100ms ease-in 0s;
				-ms-transition: opacity 100ms ease-in 0s;
				transition: opacity 100ms ease-in 0s;
				background-color: rgba(21, 21, 21, 0.75);
			}
        </style>
        <![endif]>
        <!--[if lte IE 7]>
			<style type="text/css">
				#nav ul li { display: inline; }
				.menu .menu-description { display: none; }
				.menu.hover .menu-description { display: block; background: #212121; color: #fff; }
			</style>
		<![endif]-->
		<!--[if te IE 8]>
			<style type="text/css">
				.menu .menu-description { display: none; }
				.menu.hover .menu-description {display: block; background: #212121; color: #fff; }
			</style>
		<![endif]-->
        <!--IE 9 take opasity the same as firefox-->
        <!--[if gte IE 9]>
        <style type="text/css">
        	.menu:hover .menu-description {
				opacity: 1;
				color: #fff;
				-moz-transition: opacity 100ms ease-in 0s;
				-webkit-transition: opacity 100ms ease-in 0s;
				-o-transition: opacity 100ms ease-in 0s;
				-ms-transition: opacity 100ms ease-in 0s;
				transition: opacity 100ms ease-in 0s;
				background-color: rgba(21, 21, 21, 0.75);
			}
        </style>
        <![endif]-->
         <link href='http://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet' type='text/css'>
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/da_DK/all.js#xfbml=1&appId=117587755069429";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>      

    </head>
<?php 
}?>

    <!--function for newsletters-->
<?php function newsletter() {?>
    <div id="newsletterConfirmation" style="margin-top:20px;">Du har tilmeldt vores nyhedsbreve.</div>
    <div id="newsletterContent" style="margin-top:20px;">
        <div>Tilmeld nyhedsbrev:</div>
        <form id="newsletter" method="post" action="">
             Email:<input type="text" name="n_email" style="width:130px;border:0">
             <input type="submit" id="newsletterSubmit" value="tilmeld" class="smallGreenButton">
        </form> 
    </div>
<?php }?>
    <!--//end function-->
    
<?php function footer() { ?>
    <p>Yummy sushi | Nørregade 44, 4600 Køge | Tlf: 35 10 44 50 | CVR: 29 64 87 86 | Åbningstider: 12.00 - 21.00 (alle dage)</p><p>Copyright © 2012 Yummy Sushi. All rights reserved </p><p>Powered by <a href="http://bamboo-solution.dk" target="_blank;" style="color:#f05f40;">Bamboo Solution</a></p>
<?php } ?>
    
<?php function contactRight() {?>
    <div id="contactinfo" class="white" style="font-size:18px;font-weight:bold;">
       <!-- <div style="color:red;">Vi holder lukket fra den 21.04 til den 23.04. </div>-->
        <br />
       Åbningstider:<br> ALLE dage 12.00 - 21.00 <br><br>
       Nørregade 44, 4600 Køge<br>
       Tel: 35 10 44 50 <br>
       Email: <a href="mailto:info@yummysushi.dk">info@yummysushi.dk</a><br></br>
       <div style="text-align:center;position:relative;left:-20px;" >
            <img src="include/grafix/smiley.png" width="70px" height="60px"/><br>
            <a style="color:#ffffff;" href="http://www.findsmiley.dk/da-DK/Searching/TableSearch.htm?searchtype=all&searchstring=yummy+Sushi&vtype=detail&mode=simple&display=table&dato1=&dato2=&sort=0&SearchExact=false&mapNElng=&mapNElat=&mapSWlng=&mapSWlat=&virk=" target="_blank;">www.findsmiley.dk</a>
       </div>
       </div>
<?php  


} ?>

<?php function logo() { ?>

        <div style="float:left;width:600px;"> 
            <a href="http://www.yummysushi.dk" style="position:relative; left:-20px;"><img src="include/grafix/fish_blue.png" width="200px" height="198px" /></a>
            <div>
                <h4 class="white"><a href="http://www.yummysushi.dk" >YUMMY SUSHI</a></h4>
            </div>
        </div>

        <div id="contact">
            <!-- facebook share
        <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u=http://yummysushi.dk','sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_link { position:relative; top:50px; left:130px; padding:10px 0 0 110px; height:20px; background:url(include/grafix/share.png) no-repeat top left; }</style><a rel="nofollow" href="http://www.facebook.com/share.php?u=http://yummysushi.dk" onclick="return fbs_click()" target="_blank" class="fb_share_link"></a>
-->
                <a href="http://www.yummysushi.dk/kontakt">Kontakt</a> |
                <a href="http://www.yummysushi.dk">Til forsiden</a><br />
                <div class="fb-like" data-href="https://www.facebook.com/yummysushikoge" data-send="true" data-layout="button_count" data-width="100" data-show-faces="true" data-font="arial" data-colorscheme="dark" style="padding-top:10px;"></div>
                
                <?php newsletter();?>
        </div>
    <!--
                                     <img src="include/grafix/smiley.png" style="position:absolute;top:90px;left:870px" width="70px" height="60px"/>
                                <a style="color:#ffffff;position:absolute;top:150px;left:850px;" href="http://www.findsmiley.dk/da-DK/Searching/TableSearch.htm?searchtype=all&searchstring=yummy+Sushi&vtype=detail&mode=simple&display=table&dato1=&dato2=&sort=0&SearchExact=false&mapNElng=&mapNElat=&mapSWlng=&mapSWlat=&virk=" target="_blank;">www.findsmiley.dk</a>
  -->
<?php } ?>

  
  <?php
    function convertDanishLetter($strLetter){
        $strLetter = str_replace('å','aa', $strLetter);
        $strLetter = str_replace('ø','oe',$strLetter);
        $strLetter = str_replace('æ','ae',$strLetter);
        return $strLetter;
    }
    
    function getDanishLetter($strLetter){
        $strLetter = str_replace('aa','å', $strLetter);
        $strLetter = str_replace('oe','ø',$strLetter);
        $strLetter = str_replace('ae','æ',$strLetter);
        return $strLetter;
    }

date_default_timezone_set('Europe/Copenhagen');    
$newdate = new DateTime();
$todaysdate = strtotime($newdate->format('d-m-Y'));
  ?>
