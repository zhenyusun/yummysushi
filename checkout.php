<?php 
error_reporting(E_ERROR);
/*
		$data = array();
		$i = 0;
  foreach ($_COOKIE as $name => $cart_str){
        $sushi = explode('_', $name);
        if($sushi[0] == 'sushi') {
                    $cart = explode('?', $cart_str);
                    foreach($cart as $item) {
                            $price = explode('price+', $item);
                            echo $price[1] . "this is price";
                        
                    }
                    echo "<br>.new product starts here <br>";
//echo $cart_str;
        }
    }
*/  
    require_once("include/template/site.php"); 

setlocale(LC_All, "da_DK.ISO8859-1");
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
        $order    = new Order();
} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}


//outside the outer loop
#echo_datelist(24, 0, $day, $month, $year);
$currentHour = date('H');
function echo_datelist ($i, $j, $day, $month, $year)
{
    $time = str_pad($i, 2, '0', STR_PAD_LEFT).':'.str_pad($j, 2, '0', STR_PAD_LEFT);            
    $date = strtotime("$month $day $year $time:00");

    echo $time;
}

$begin = new DateTime(date('H:i'));
$end   = new DateTime("20:40");

$interval = DateInterval::createFromDateString('25 min');

$times    = new DatePeriod($begin, $interval, $end);

/*
function selectTimesOfDay() {
    $open_time = time() > strtotime("14:00") ? time() : strtotime("14:00");
    $close_time = strtotime("24:00");
    $now = time();
    $output = "";
    for( $i=$open_time; $i<$close_time; $i+=300) {
        if( $i <= $now) continue;
        $output .= "<option value='".date("H:i",$i)."'>".date("H:i",$i)."</option>";
    }
    return $output;
}
*/

?>

<?php headdocs();?>

    <body>
		<div id="wrap">
			<div id="header">
 <?php logo();?>
			</div>
			<div id="main">
				<div id="left">
                                    <!--
                                    <div class="white" style="color:red;">
                                        Vi holder ferielukket fra d. 17 juli til d. 23 juli. Vi er tilbage igen torsdag d. 24 juli. Vi ses og god sommer!!!<br><br>
                                    </div>
                                    -->
                                        <div id="confirmation" class="white">
                                            Tak for din bestilling, vi har sendt en mail til dig for orderbekræftelsen.

                                        </div>
					<!-- customer info -->	
					<div class="checkout" id="checkoutcontent">
						<form id="basket" method="post" action="">
						<fieldset>
							<div class="row">
                                                            <label for="checkout_orderinfo">Tid<span class="req">*</span></label>
								<select id="checkout_orderdate" name="co_orderdate">
									<?php for($i=0; $i<14; $i++) {?>
										<option value="<?php echo Date("Y-m-d", strtotime("+".$i." days"))?>"><?php echo Date("l, d-m-Y", strtotime("+".$i." days"))?></option>
									<?php }?>
								</select>
								
                                                                <select id="checkout_ordertime" name="checkout_ordertime">
                                                                    <?php 
                                                                    #$day="";
                                                                    #$month="";
                                                                    #$year="";
                                                                    for ($i = 12; $i <= 20; $i++)
                                                                        {
                                                                            $startminute = $i == 12 ? 20 : 0;
                                                                            for ($j = $startminute; $j <= 40; $j+=20)
                                                                            {
                                                                    ?>
                                                                    <option value="<?php echo_datelist($i, $j, $day, $month, $year);?>">
                                                                            <?php 
                                                                                    echo_datelist($i, $j, $day, $month, $year);
                                                                            ?>
                                                                    </option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
							</div>
							 <div class="row">
								<label for="checkout_name">Navn<span class="req">*</span></label>
								<input type="text" id="checkout_name" name="co_name" value="" />
							  </div>
							 <div class="row">
								<label for="checkout_name">Email<span class="req">*</span></label>
								<input type="text" id="checkout_email" name="co_email" value="" />
							  </div>        
							  <div class="row">
								<label for="checkout_address">Adresse<span class="req">*</span></label>
								<input type="text" id="checkout_address" name="co_address" value="" />
							  </div>
							  <div class="row">
								<label>Postnummer<span class="req">*</span></label>
								<input type="text" id="postnummer" name="co_postnummer" value=""/>
							  </div>
							  <div class="row">
								<label>By</label>
								<input type="text" id="city" name="co_city" value="" />
							  </div>
							  <div class="row">
								<label for="checkout_phone">Telefonnummer<span class="req">*</span></label>
								<input type="text" id="checkout_phone" name="co_phone" value="" />
							  </div>
							  <div class="row">
								<label for="checkout_adults">Antal Personer<span class="req">*</span></label>
								<input class="short" type="text" id="checkout_adults" name="co_adults" value="" />
							  </div>
							  
                                                        <div class="row" id="afhentningsmetode">
                                                                <span>Hvordan ønsker du at få mad leveret?</span><span class="req">*</span><br>
                                                                <span>afhentning</span>
								<input type="radio" id="checkout_afhentning" value="1" name="co_afhentning" checked="checked"/>
								<!--
                                                                <span >udbringning</span>
                                                                <input type="radio" id="checkout_udbringning" value="2"name="co_afhentning" /> 
                                                                <span id="afhentningsbesked"><br>Vi ringer tilbage hurtigest muligt til at bekræfte din bestilling.</span>
                                                                <span id="udbringningsbesked"><br><span class="attention">(Kun torsdag, fredag, lørdag og søndag, efter kl. 17.00)</span><br>Leveringstiden varierer fra 1 til 1.5 time alt efter, hvor travlt vi har i forretningen. Vi ringer tilbage hurtigest muligt og bekræfter leveringstiden</span>
							  -->
							  </div>
							  
							  <div class="row">
								<label for="checkout_comment">Kommentar</label>
								<textarea id="checkout_comment" name="co_comment" rows="2" cols="25"></textarea>
							  </div>
						</fieldset>
						<input style="position:relative; right:-220px; cursor:pointer; margin-top:10px; background-color:#25421c; border:0; width:100px; padding:5px 10px; color:#ffffff;" type="submit" id="submit" value="Bestil" />
						</form>
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
					</div><!-- end #cart -->
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
