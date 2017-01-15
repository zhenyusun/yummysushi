<?php 
    require_once("include/template/site.php"); 
    //autoloader
    function __autoload($class_name) {
		if(file_exists('include/classes/' . $class_name . '.php')) {
			require_once('include/classes/' . $class_name . '.php');   
		} else {
			throw new Exception("Unable to load $class_name.");
		}
	}
    //instantiate classes
    try {
		$product  = new Product();
		$category = new Category();
	} catch (Exception $e) {
		echo $e->getMessage(), "\n";
	}
    
    //handle URI to get category info
	


?>
<?php headdocs();?>
    <body>
		<div id="wrap">
			<div id="header">
                              <?php logo();?>
			</div>
			<div id="main">
                            <div id="left" >
                                      <!--  <div style="color:#E8BE07;">Vi lukker og holder ferie fra d. 24 juli til d. 15 august. Vi skal giftes i hjemlandet. Så vi ses igen d. 16 august. God sommer!!!</div> -->
                                <div style="color:#E8BE07;font-size:16px;">Vi har åbent 25-26, Dec. Vi har lukket 23-24, Dec. 1, Jan. <br /><span style="font-size:24px;font-weight: bold;">Glædelig Jul og Godt Nytår.</span></div>
                                <h1>Velkommen til at bestille vores Yummy-Sushi online.</h1><br>
                                <!--
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                        <h1>Valentines Menu</h1>
                                    </div>
                                    <br>
                                        <img src="include/grafix/valentine_forside.jpg" width="600"/>   
                                         <a style="color:#000000;position:relative;top:-280px;left:20px;font-size:30px;" href="http://www.yummysushi.dk/menuer.html">Bestil til Valentinesdag</a>
                                 
                                </div>
                                -->
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                        <h1>Nytårs Menu</h1><br>
                                        Kære alle, vores nytårsmenu er klar. I er velkommen til at bestille vores lækre sushi. <span style="font-size:20px;color:#E8BE07;">Husk at bestille i god tid. Velbekomme!</span>
                                    </div>
                                    <br>
                    
                                         <a  href="http://www.yummysushi.dk/menuer.html"><img src="include/grafix/forside_newyear.jpg" width="600"/>   </a>
                                 
                                </div>                     
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                        <h1>Specielt Tilbud!</h1><br>
                                        Yummy Winter Menu fortsætter i januar og februar.

                                    </div>
                                    <br>
                                           
                                         <a  href="http://www.yummysushi.dk/menuer.html"><img src="include/grafix/forside_yummy_winter.jpg" width="600"/></a>
                                 
                                </div>
                                
<!--
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                        <h1>Overraske menu hver måned!</h1><br>
                                        Her er vores februar menu-Hungry 16 stk, derefter har vi hver måned spændende menuer kommer. Så hold øje med vores hjemmeside på yummysushi.dk. 

                                    </div>
                                    <br>
                                        <img src="include/grafix/forside_1.jpg" width="600"/>   
                                         <a style="color:#000000;position:relative;top:-280px;left:20px;font-size:30px;" href="http://www.yummysushi.dk/menuer.html">Bestil nu</a>
                                 
                                </div>
-->
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;float:left; width:400px;">
                                        <h1>10% rabat til studerende!</h1><br>
                                        Vi giver 10% studierabat på hele menuer all dage. Fremvisning af et gyldigt studiekort ved afhentening. Rabatten kan ikke bruges i forbindes med andre tilbud og gives til andre folk. 
                                    </div>
                                    <div style="margin-top:5px;float:right; width:200px">
                                        <img src="include/grafix/rabat.jpg" />
                                    </div>
                                </div>
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;float:left; width:400px;">
                                        <h1>Happy Mondays!</h1><br>
                                        Køb vores menuer 1-7 om mandagen, giver vi 10% rabat. <br>
                                        (Tilbud gælder ikke ved udbringningen og JUST-EAT bestillingen)                                 
                                    </div>
                                    <div style="margin-top:5px;float:right; width:200px">
                                        <img src="include/grafix/happy_monday.jpg" />
                                    </div>
                                </div>
                                <!--
                                <img src="include/grafix/menu_985.png" width="985" height="500px"/>      
                                -->
                                
 
                            </div>
                            <div id="right">
                                <div style="display:none;">
                                    <h3 class="white">Indkøbskurv</h3>
                                    <div id="cart" class="white">
                                            <ul id="items" class="empty white">
                                                    <li></li>
                                            </ul>
                                            <ul id="total" class="empty white">
                                                    <li><span>0</span>kr</li>
                                            </ul>
                                            <a id="buy" class="empty" href="/bestilling.html"><span>Gå til bestilling</span></a>
                                       
                                         
                                    </div>
                                </div>
                                <div id="frongpagerightcolumn" style="top:-50px;position:relative;">
                                     <?php contactRight();?>
                                    <a href="http://www.just-eat.dk/restaurants-yummisushi/menu" target="_blank" style="position:relative;top:20px;left:20px;">
                                        <img src="include/grafix/just_eat.jpg" width="200"/>  
                                    </a>
                                </div>
                            </div><!-- end #right -->
                                    
                      
                                
                            </div><!-- end #main -->

                    <div id="footer">
                        <?php footer();?>
                    </div>
		</div><!-- end #wrap -->
		<?php include('inc/nav.inc.php'); ?>
		<?php /*<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> */ ?>
		<script type="text/javascript" src="include/js/jquery-1.8.2.js"></script>
		<script type="text/javascript" src="include/js/pbsushi.js"></script>
		<!--[if IE]>
		<script type="text/javascript">
			(function($) {
				$('.menu','#food').hover(
					function() {
						$(this).addClass('hover');
					},
					function() {
						$(this).removeClass('hover');
					}
				);
			})(jQuery);
		</script>
		<![endif]-->
    </body>
</html>
