<?php 
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
error_reporting(E_ERROR);
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
                                <h1>Velkommen til at bestille vores Yummy-Sushi online.<br />Husk venligst at bestille i god tid. Bon Appetit!</h1><br>
                                

                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                       <br>
                                       Hos os kan du smage kvalitet og få en ekstra god service til fordelagtige priser. <br><br>
                                       Friske råvarer i 1. kvalitets klassen er vores kendetegn. <br><br>
                                       Vi lager også mad ud af huset til fester mm.
                                    </div>
 
                                 
                                </div>   
                                <!--
                                <div class="smallcontainer">
                                    <div style="margin-top:10px;">
                                        <h1>Specielt Tilbud!</h1><br>
                                        Yummy Yummi normal pris er 190kr, men nu er kun 125kr. Bon Appetit!
                                    </div>
                                    <br>
                    
                                         <a  href="http://www.yummysushi.dk/menuer.html"><img src="include/grafix/forside_yummi.jpg" width="600"/>   </a>
                                 
                                </div>   

                                <div class="smallcontainer">
                                    <div style="margin-top:10px;float:left; width:400px;">
                                        <h1>10% rabat til studerende!</h1><br>
                                        Vi giver 10% studierabat for 1-2 personer på hele menukortet alle dage ved fremvisning af et gyldigt studiekort ved afhentning. Rabatten kan ikke bruges i forbindelse med andre tilbud og gives til andre folk. 
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
-->
                                
 
                            </div>
                            <div id="right">
                                <!--this part for the basket is only to show the categories for index.php-->
                                <div style="display:none;">
                                    <h3 class="white">Indkøbskurv</h3>
                                    <div id="cart" class="white">
                                            <ul id="items" class="empty white">
                                                    <li></li>
                                            </ul>
                                            <ul id="total" class="empty white">
                                                    <li><span>0</span>kr</li>
                                            </ul>
                                          <a id="buy" class="empty" href="/bestilling.html"><span>Gå til bestilling</span></a>-->
                                       
                                         
                                    </div>
                                </div>
                                <div id="frongpagerightcolumn" style="top:-50px;position:relative;">
                                     <?php contactRight();?>
									 <!--
                                    <a href="http://www.just-eat.dk/restaurants-yummisushi/menu" target="_blank" style="position:relative;top:20px;left:20px;">
                                        <img src="include/grafix/just_eat.jpg" width="200"/>  
                                    </a>
									-->
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
