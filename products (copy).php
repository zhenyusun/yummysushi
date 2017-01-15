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
	
	//Remove request parameters:
	list($path) = explode('?', $_SERVER['REQUEST_URI']);
	//Remove script path:
	//+1 is not needed on my server - check production
	//$path = substr($path, strlen(dirname($_SERVER['SCRIPT_NAME']))+1);
	$path = substr($path, strlen(dirname($_SERVER['SCRIPT_NAME'])));
	//Explode path to directories and remove empty items:
	$cat_path = array();
	foreach (explode('/', $path) as $dir) {
		//echo $dir;
		if (!empty($dir)) {
			$cat_path[] = urldecode($dir);
		}
	}
	if (count($cat_path) > 0) {
		//Remove file extension from the last element:
		$last = $cat_path[count($cat_path)-1];
		list($last) = explode('.', $last);
		$cat_path[count($cat_path)-1] = $last;
	}
	
	//Get category ID based on request path
	//$cur used to mark current page in menu
	if(!empty($cat_path[0])) {
		$cat = $category->getCatByName($cat_path[0]);
		$cur = $cat_path[0];
	} else {
		//is homepage - show category 'menuer'
		$cat = $category->getCatByName('menuer');
		$cur = 'menuer';
	}
        
        define('CATNAME',$cat_path[0]);
?>
<?php headdocs();?>
    <body>
		<div id="wrap">
			<div id="header">
                              <?php logo();?>
			</div>
			<div id="main">
				<div id="left">
					<h2 class="white"><?php echo $cat->ca_name ?></h2>
					<div id="food">
                        <?php foreach ($product->getProducts($cat->ca_id) as $prod):
                            $product->setProductID($prod->p_id);
                            
                            if ($product->getProductsPackByProductID()){
                                foreach($product->getProductsPackByProductID() as $packs1):
                                $strid = $packs1->pp_pid;
                                endforeach;
                            }else {
                               $strid = convertDanishLetter(str_replace(' ','-',strtolower($prod->p_name))) . "-" . $prod->ca_url . "_" . $prod->p_price;
                            }
                            
                            $i = $i +1 ;
                            $strFloat = $i % 2 == 0  ? 'right' : 'left';
                            
                        ?>

						<div id="<?php echo $strid ?>" class="menu" style=<?php echo "float:".$strFloat;?>>
							<div class="menu-title">
								<h1><?php echo $prod->p_name ?></h1>
                                                                
								
                                                                <?php 
                                                                if ($product->getProductsPackByProductID()){
                                                                    foreach($product->getProductsPackByProductID() as $packs): ?>
                                                                   
                                                                        <p>
                                                                            <input type="radio" name="<?php echo $prod->p_name?>" value="<?php echo str_replace(' ','/',str_replace(' ','-',strtolower($prod->p_name))) . "-" . str_replace(' ','-',strtolower($packs->pp_pname)) . "-" . $prod->ca_url . "_" . $packs->pp_pprice;?>"><?php echo $packs->pp_pname . " / " . $packs->pp_pprice;?> kr<br>
                                                                        </p>
                                                                <?php 
                                                                    endforeach;
                                                                }else{?>
                                                                <p><?php echo $prod->p_price ?> kr</p>                                                                
                                                                <?php }
                                                                ?>
								<a title="Add to Basket">Add to Basket</a>
							</div><!--end .menu-title -->
							<div class="menu-image">
								<img src="<?php echo "include/images/".strtolower($prod->ca_url)."/".$prod->p_image.".jpg" ?>" />
							</div>
							<div class="menu-description">
                                <?php echo $prod->p_description ?>
							</div>
						</div><!--end .menu -->
					   <?php endforeach; ?>            
					</div><!-- end #food -->
				</div><!-- end .left -->
				<div id="right">
					<h3 class="white">Indkøbskurv</h3>
					<div id="cart" class="white">
						<ul id="items" class="empty white">
							<li></li>
						</ul>
						<ul id="total" class="empty white">
							<li><span>0</span>kr</li>
						</ul>
						<a id="buy" class="empty" href="/bestilling.html"><span>Gå til bestilling</span></a>
                                                <?php contactRight();?>
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
