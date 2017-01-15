<?php 
setlocale(LC_All, "da_DK.ISO8859-1");
//autoloader
require_once("include/template/site.php"); 

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
?>

<?php headdocs();?>
    <body>
		<div id="wrap">
			<div id="header">
 <?php logo();?>
			</div>
			<div id="main">
				<div id="left">
                                    <div id="contactinfo" class="white">

                                    <h1>Yummy sushi</h1>
                                    Nørregade 44, <br>
                                    4600 Køge<br><br>
                                    
                                    tel: 35 10 44 50 <br>
                                    email: <a href="mailto:info@yummysushi.dk">info@yummysushi.dk</a><br></br>
                                    
                                    åbningstider: ALLE dage 12.00 - 21.00 <br><br>
                                    <!-- customer info -->	
                                    </div>
                                    <div>
                                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.dk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=N%C3%B8rregade+44,+K%C3%B8ge&amp;aq=1&amp;oq=n%C3%B8rregade+44+&amp;sll=55.59332,13.426026&amp;sspn=1.939992,5.817261&amp;ie=UTF8&amp;hq=&amp;hnear=N%C3%B8rregade+44,+4600+K%C3%B8ge&amp;ll=55.459593,12.184152&amp;spn=0.000999,0.00284&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.dk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=N%C3%B8rregade+44,+K%C3%B8ge&amp;aq=1&amp;oq=n%C3%B8rregade+44+&amp;sll=55.59332,13.426026&amp;sspn=1.939992,5.817261&amp;ie=UTF8&amp;hq=&amp;hnear=N%C3%B8rregade+44,+4600+K%C3%B8ge&amp;ll=55.459593,12.184152&amp;spn=0.000999,0.00284&amp;t=m&amp;z=14" style="color:#ffffff;text-align:left">View Larger Map</a></small>				
                                    </div>
                                </div>
                            
				<div id="right">
					<h3 class="white">Indkøbskurv</h3>
					<div id="cart">
						<ul id="items" class="empty  white">
							<li></li>
						</ul>
						<ul id="total" class="empty  white">
							<li><span>0</span>kr</li>
						</ul>
					</div>
				</div>   
                    
			</div>
                    <div id="footer">
                        <?php footer();?>
                    </div>
                </div>
	<?php include('inc/nav.inc.php'); ?>
	<script type="text/javascript" src="include/js/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="include/js/pbsushi.js"></script>
    </body>
</html>