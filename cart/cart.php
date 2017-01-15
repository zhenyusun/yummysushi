<?php

/*
*Store/persist shopping cart
* NOTES/GOTCHAS:
* - cart cookies 
*	- must be set across entire domain '/'
*	- use 'sushi_' as prefix so we can find them 
*/
    function __autoload($class_name) {
		if(file_exists('../include/classes/' . $class_name . '.php')) {
			require_once('../include/classes/' . $class_name . '.php');   
		} else {
			throw new Exception("Unable to load $class_name.");
		}
	}
    //instantiate classes
    try {
		$order  = new Order();
		$customer = new Customer();
	} catch (Exception $e) {
		echo $e->getMessage(), "\n";
	}

switch($_POST['action']) {
	case 'set':
		/*
		$_POST looks like:
		
		Array
		(
			[action] => set
			[cart_item] => Array
				(
					[name] => menu-code-bar
					[price] => 250
					[path] => include/images/menu-code-foo.jpg
				)
		
		)
		*/
		//if cookie is already set, do nothing
		$item_name = "";
		if (isset($_COOKIE['sushi_' . $item_name]))
			return;
			
		$cart_item = $_POST['cart_item'];
		$item_name = $cart_item['name'];
		
		//convert $cart_item to key val string
		//name=menu-code-foo?price=125?path=include/images/menu-code-foo.jpg?qty+1?
		$cart_str = '';
		foreach($cart_item as $key => $val)
				$cart_str .= $key . '+' . $val . '?';
				
		//set cookie value for cart item
		setcookie('sushi_' . $item_name, $cart_str, time() + 3600*24,'/');
		
		break;
	case 'remove';
		/*
		$_POST looks like:
		
		Array
		(
			[action] => remove
			[name] => menu-code_price (is a string)
		)
		*/
		//unset cookie for cart item
		setcookie('sushi_' . $_POST['name'], '', time() - 3600,'/');
		break;
	case 'get':
		
		/*
		Return data like this:
		Array
		(
			Array
				(
					[name] => menu-code-bar
					[price] => 250
					[path] => include/images/menu-code-foo.jpg
					[qty] => 1
				),
			Array
			(
				[name] => menu-code-bar
				[price] => 250
				[path] => include/images/menu-code-foo.jpg
				[qty] => 1
			)
		
		)
		*/
		$data = array();
		$i = 0;
		foreach($_COOKIE as $name => $cart_str) {
			//filter out cookies that are not ours
			$sushi = explode('_', $name);
			if($sushi[0] == 'sushi') {
				//explode cart string into array like:
				//name=menu-code-bar, price=250, path=include/images/menu-code-foo.jpg
				$cart = explode('?', $cart_str);
				//remove last empty array value caused by extra ? at end of $cart_str
				//array_pop($cart); - not used as we are manually setting QTY at end of string now
				//even if we add more data for cart items, this will always entire cart
				//item as key => val pairs
				//JSON returned looks like:
				//Object { name="menu-code-foo", price="125", path="include/images/menu-code-foo.jpg"}
				//Object { name="menu-code-bar", price="250", path="include/images/menu-code-bar.jpg"}
				foreach($cart as $item) {
					$kv = explode('+', $item);
					if(isset($kv[1])){
						$data[$i][$kv[0]] = $kv[1];
					}
				}			
				$i ++;
			}
		}
		if(!empty($data)){
			echo json_encode($data);
                }else{
			echo 'no-cart-item';
                }
		break;
	case 'qty':
		/*
		$_POST looks like:
		
		Array
		(
			[action] => qty
			[name] => menu-code-bar
			[qty] => 1
		
		)
		*/
		//get cookie val
		$og_val = $_COOKIE['sushi_' . $_POST['name']];
		$exp    = explode('qty+', $og_val);
		
		setcookie('sushi_' . $_POST['name'], $exp[0] . 'qty+' . $_POST['qty'], time() + 3600*24,'/');		
		break;
	case 'checkout':
            /*
		Array
		(
			[action] => "checkout",
			[data] => Array
				(
					[co_name] => "Travis",
					[co_email] => "travis@gjgj",
					[co_address] => "test",
					[undefined] => "af",
					[co_phone] => "121",
					[co_adults] => "12",
					[co_comment] => "212121"
				)
		
		);
		*/
                $customerdata = $_POST['data'];
                $customer->setCustomerName($customerdata['co_name']);
                $customer->setCustomerEmail($customerdata['co_email']);
                $customer->setCustomerPhone($customerdata['co_phone']);
                $customer->setCustomerPostnumber($customerdata['co_postnummer']);
                $customer->setCustomerCity($customerdata['co_city']);
                $customer->setCustomerAddress($customerdata['co_address']);
                $customer->addCustomers();
                
                $lastCustomerID = $customer->getLastCustomersID();
                foreach($lastCustomerID as $row){
                    $order->setCustomerID($row->c_id);
                }
                
                $orderdatetime = $customerdata['checkout_orderdate'] . " " . $customerdata['checkout_ordertime'] . ":00";

                $order->setNoOfPeople($customerdata['co_adults']);
                $order->setDatetime($orderdatetime);
                $order->setDelivery($customerdata['deliverymethod']);
                $order->setComment($customerdata['co_comment']);
                $order->addOrders();
                
                $lastOrderID = $order->getLastOrderID();
                foreach($lastOrderID as $row){
                    $order->setOrderID($row->o_id);
                    $_SESSION["orderid"] = $row->o_id;
                }

                $data = array();
		$i = 0;
                foreach ($_COOKIE as $name => $cart_str){
                      $sushi = explode('_', $name);
                      if($sushi[0] == 'sushi') {
                                  $cart = explode('?', $cart_str);
                                  foreach($cart as $item) {
                                      if(strpos($item,'price+')!==false){
                                          $price = explode('price+', $item);
                                          $order->setPrices($price[1]);
                                      }
                                    if(strpos($item,'name+')!==false){

                                          $pname = explode('name+', $item);
                                          $order->setProductName($pname[1]);
                                    }
                                    if(strpos($item,'qty+')!==false){
                                          $quantity = explode('qty+', $item);
                                          $order->setProductQuantity($quantity[1]);                 
                                    }
                                  }
                                $order->setProductID(0);
                                $order->addOrderItem();
                      }
                }
?>
                                            <?php 
                                               # $emailContent .= "<div style='color:red;'>Vi holder ferielukket fra d. 17 juli til d. 23 juli. Vi er tilbage igen torsdag d. 24 juli. Vi ses og god sommer!!!</div><br><br>";                     
                                                $emailContent .= "Tak for din bestilling. Vi laver din mad klar på det tidspunkt du har valgt, og følgende din ordreinformation.<br>";
                                                $deliverytext = $customerdata['deliverymethod'] <= 1 ? "afhentning" : "udbringning";
                                                $headers  = "MIME-Version: 1.0" . "\r\n";
                                                    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";                                      
                                                foreach ($order->getCustomersByOrderID() as $prod): ?>
                                            <div>
                                                <?php 
                                                    // To send HTML mail, the Content-type header must be set

                                                    $emailContent .= "<br>".$prod->c_name . "<br>". $prod->c_phoneno . "<br>".$prod->c_email . "<br>" .$prod->c_address. "<br>" . $prod->c_postnumber . " ". $prod->c_city ."<br>";
                                                    $emailContent .="-----------------------<br>";
                                                    $emailContent .= "<b>".$prod->o_ordertime."</b><br>";
                                                    $emailContent .= "<b>".$prod->o_people." person(er)</b><br><br>";
													foreach($order->getOrderItemsByOrderID() as $orderitems):
                                                        $emailContent .=$orderitems->oi_quantity . " * ". $orderitems->oi_pname . " (" . $orderitems->oi_quantity * $orderitems->oi_price ."kr)". "<br>";
                                                    endforeach;
                                                    $emailContent .= "<br>------------------------<br>";
                                                    $emailContent .= "<b>hvordan ønsker du at få mad leveret?</b><br />";
                                                    $emailContent .=  $deliverytext . "<br>";
                                                    $emailContent .= "<br>------------------------<br>";
                                                    $emailContent .= "<b>bemærkninger: </b>" . $prod->o_comment;
                                                       // Additional headers
                                                    $headers .= "from:info@yummysushi.dk";
                                                    $subject = "Order information - Yummysushi";
                                                    // Mail it
                                                    mail("no-reply@bamboo-solution.dk", $subject, $emailContent, $headers);
                                                   // mail("peterxunzhang@yahoo.com.cn", $subject, $emailContent, $headers);
                                                    mail("info@yummysushi.dk", $subject, $emailContent, $headers);
												   //mail("yanyan0828@yahoo.com", $subject, $emailContent, $headers);
                                                   // mail("lavender20021011@gmail.com", $subject, $emailContent, $headers);

                                                    #copy of email for customers
                                                    mail($prod->c_email, $subject, $emailContent,$headers );
                                                ?>
                                                
                                            </div>
                                            <?php endforeach;?>                
<?php
#echo mysql_insert_id();
		print_r($_POST);
		break;
                case 'submitNewsletter':
                    $newsletterdata = $_POST['data'];
                    $customer->setNewsletterEmail($newsletterdata['n_email']);
                    $customer->addNewsletters();
                break;
}
?>
