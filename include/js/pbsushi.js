//add forEach support to older browsers
if ( !Array.prototype.forEach ) {
  Array.prototype.forEach = function(fn, scope) {
    for(var i = 0, len = this.length; i < len; ++i) {
      fn.call(scope, this[i], i, this);
    }
  }
}

/*
TO DO - need to fix pricing price updates after moving things to the input
- fix updatePrice
- finish change function
*/

(function($) {
	var elem = {
			$w: $(window), 
			$m: $('h2','#left'),
			$k: $('h3','#right'),//inkøbskurv heading
			$c: $('#cart'),//cart container
			$i: $('#items'),//part of cart that takes products
			$t: $('#total'),//part of cart that holds prices
			$f: $('#food'),
			$n: $('#nav'),
			$a: $('#buy'),
                        $z: $('#frongpagerightcolumn')
		},
		hh = $('#header').outerHeight();
	//run on load
	stayTop(hh, elem.$w.scrollTop(), elem);
	//persist cart	
        var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test( userAgent );
	getCart(elem);
	
	//run on window scroll
	elem.$w.scroll(function() {
		var p = $(this).scrollTop();
		stayTop(hh, p, elem);
	});

        $("input[type='radio']").click(function() {
		var packid   = $(this).val();
                $(this).closest('.menu').attr('id',packid);
	});
	
	//bind add cart events
	$('a','#food').click(function() {
		var id   = $(this).closest('.menu').attr('id'),
			exp  = id.split('_'),
			prod = {
				name: exp[0],
				price: exp[1],
				path: $(this).parent().next().children().attr('src')
			}
		;
		//replace empty <li> if there is no persisted cart
		if($('li', elem.$i[0]).children().size() == 0) {
			$('ul', elem.$c[0]).removeClass('empty');
			elem.$a.removeClass('empty');
			$('li:first', elem.$i[0]).remove();		
		}
                if (prod['name'].length > 3){
		addCart(prod, elem, false);
                }
                if( ios ) {
                    setTimeout(function(){location.reload()},1000);
                }               
	});
	
	//remove items from cart
	elem.$i.on('click', 'a.remove',function(e) {
		var $li = $(this).closest('li');
		$li.remove();
		//remove from PHP cookie	
		removeCart($li);
		if($('li', elem.$i[0]).size() == 0) {
			//.empty on all #cart ul
			$('ul', elem.$c[0]).addClass('empty');
			elem.$a.addClass('empty');
		}
                if(ios){
                    setTimeout(function(){location.reload()},1000);
                }
	});
	
	//change qty
	elem.$i.on('click', 'a.plus',function(e){
		var $qty = $(this).parent().prev(),
			qty  = $qty.val();
		qty ++;
		$qty.val(qty);
		//get name of cart item
		var name = $(this).closest('li').attr('id').split('_');
		updateQty(name[1], qty);
		//update price on client side
		
		var $pce = $(this).parent().next().children('span');
		updatePrice(elem, qty, $pce);
                setTimeout(function(){location.reload()},1000);
	});
	
	elem.$i.on('click', 'a.minus',function(e){
		var $qty = $(this).parent().prev(),
			qty  = $qty.val();
			if(qty > 1) {
				qty --;
				$qty.val(qty);
				//get name of cart item
				var name = $(this).closest('li').attr('id').split('_');
				updateQty(name[1], qty);
				//update price on client side
				var $pce = $(this).parent().next().children('span');
				updatePrice(elem, qty, $pce);
                                setTimeout(function(){location.reload()},1000);
			}
	});
	
	elem.$i.on('change', 'input', function() {
		var qty = $(this).val(),
			$li = $(this).closest('li'),
			$pce = $(this).nextAll().eq(1).children('span');
		switch(qty) {
			case '0':
				$li.remove();
				//remove from PHP cookie	
				removeCart($li);
				if($('li', elem.$i[0]).size() == 0)
					$('ul', elem.$c[0]).addClass('empty');
					elem.$a.addClass('empty');
				break;
			default:
				var name = $li.attr('id').split('_');
				updateQty(name[1], qty);
		}
		updatePrice(elem, qty, $pce);
	});
	
                /*Form submit*/
                var $cf = $('#basket'),
		$cs = $('#submit');
                
                $("#confirmation").hide();
                $("#udbringningsbesked").hide();  
                $("#afhentningsbesked").hide();  
                $deliverymethod = "";

                    $("#checkout_afhentning").click(function(e){
                        $("#afhentningsbesked").show();
                        $("#udbringningsbesked").hide();  
                        $deliverymethod = $(this).val();
                    });

                    $("#checkout_udbringning").click(function(e){
                        $("#udbringningsbesked").show();
                        $("#afhentningsbesked").hide(); 
                        $deliverymethod = $(this).val();
                    });
        		
		$cs.click(function(e) {
			e.preventDefault();
			var data = {};
			//get customer details
			$('input:text', $cf).each(function(i) {
				var test = $(this).val();
				data[$(this).attr('name')] = $(this).val();
			});
			data['co_comment'] = $('textarea', $cf).val();
                        data['checkout_orderdate'] = $('#checkout_orderdate', $cf).val();
                        data['checkout_ordertime'] = $('#checkout_ordertime', $cf).val();
                        data['deliverymethod'] = $deliverymethod;
                        if(data['co_name'].length >= 1 && data['co_phone'].length >= 8 && data['co_postnummer'].length >= 4 && atLeastOneRadio()) {
                            placeOrder(data);
                            $("#checkoutcontent").hide();
                            $("#confirmation").show();
                        }else{
                            $errormessage = "";
                            if(data['co_name'].length < 1){
                                $errorname = "* navnet skal udfyldes. \n";
                                $errormessage = $errorname ;
                            }   
                            if(data['co_phone'].length < 8){
                                $errorphone = "* telefon nr skal være mindst 8 cifret.\n";
                                $errormessage = $errormessage + $errorphone;
                            }  
                            if(data['co_postnummer'].length < 4){
                                $errorpostnummer = "* postnr. skal være mindst 4 cifret.\n";
                                $errormessage = $errormessage + $errorpostnummer;
                            }                               
                            if(!atLeastOneRadio()){
                                $errorafhentning = "* afhentnings metode skal vælges\n";
                                $errormessage = $errormessage + $errorafhentning;
                            }
                            //alert($errorname + '\n' + $errorphone);
                            alert($errormessage);
                        }
			return false;
		});
                /*
                 *nl = newsletter form
                 *ns = newsletterSubmit
                 */
                $("#newsletterConfirmation").hide();
                var $nl = $('#newsletter'),
		$ns = $('#newsletterSubmit');
		
		$ns.click(function(e) {
			e.preventDefault();
			var data = {};
			//get customer details
			$('input:text', $nl).each(function(n) {
				data[$(this).attr('name')] = $(this).val();
			});

			newsletterSubscribe(data);
                        $("#newsletterContent").hide();
                        $("#newsletterConfirmation").show();
                        return false;
		});		
})(jQuery);

function atLeastOneRadio() {
    return ($('input[type=radio]:checked').size() > 0);
}

function addCart(item, elem, load) {
	load = typeof load === 'undefined' ? false : load;
	//prevent duplicates in the cart
	if($('#cart_'+ item.name +'_'+ item.price +'').length != 0) {
//@todo - translate to Danish		
		alert('Item is already in your basket');
		return;
	}
	
	//prepare dom element for insertion
	var pathExp = item.path.split('.'),
		pathSm  = pathExp[0] + '_sm.jpg';
	
	var li = '<li id="cart_'+ item.name +'_'+ item.price +'">';
	li += '<img src="'+ pathSm +'" />';
	li += '<div class="cart-detail">';
	li += '<strong>';
	var name = item.name.split('-'),
		words = '';
	name.forEach(function(word) {
    	words += word.charAt(0).toUpperCase() + word.substr(1) + ' ';
  	});
	li += words + '</strong>';
	li += '<div class="qty-detail">';
	item.qty  = load ? item.qty : 1;
	li += '<input type="text" value="' + item.qty + '" />';
	li += '<div class="controls">';
	li += '<a class="plus">+</a>';
	li += '<a class="minus">-</a>';
	li += '</div>';
	if(load)
		li += '<p class="price"><span>' + (item.qty * item.price) + '</span>kr<input type="hidden" value="' + item.price + '" /></p>';
	else
		li += '<p class="price"><span>' + item.price + '</span>kr<input type="hidden" value="' + item.price + '" /></p>';
	li += '<a class="remove">Remove</a>';
	li += '</div>';
	li += '</div>';
	li += '</li>';
	
	//set cart item to php cookie
	setCart(elem, li, item, load);
	
}

function getCart(elem) {
	$.ajax({
		type: 'POST',
		url: '../../cart/cart.php',
		dataType: 'json',
		data: { action: 'get' },
		success: function(items) {
			if(items != 'no-cart-item') {
				$.each(items, function(i,v) {
					var item = {};
					item[i] = v;
					addCart(v, elem, true);
				});
				//remove first empty <li> on load
				$('li:first', elem.$i[0]).remove();
				//update total price bar
				updatePrice(elem);
				//show checkout button
				elem.$a.removeClass('empty');
				//remove .empty from both #items and #total
				$('ul',elem.$c[0]).removeClass('empty');
			}
			//else do nothing as there is no cart item
		}
	});
}

function setCart(elem, li, item, load) {
	if(!load) {
		//a new cart item is being set
		//php cookie needs to be set
		$.ajax({
			type: 'POST',
			url: '../../cart/cart.php',
			data: { action: 'set', cart_item: item },
			success: function() {
				//item is passed to function, not returned from php
				elem.$i.append(li);
				updatePrice(elem, item.qty, null);
			}
		});
	} else {
		//simply append cart items as php cookie is already set
		elem.$i.append(li);
	}
}

function removeCart(item) {
	//item is jQuery object
	var code = item.attr('id').split('_');
	$.ajax({
		type: 'POST',
		url: '../../cart/cart.php',
		data: { action: 'remove', name: code[1] }
	});
	//sends cart_item as string 'menu-code'
}

function updateQty(name, qty) {
	$.ajax({
		type: 'POST',
		url: '../../cart/cart.php',
		data: { action: 'qty', name: name, qty: qty }
	});
}

function updatePrice(elem, qty, $tar) {	
	qty  = typeof qty === 'undefined' ? 0 : qty;
	$tar = typeof $tar === 'undefined' ? null : $tar; 
	
	//if(update) clicking +- else adding first time
	var $t_pce = $('li span', elem.$t[0]),
		sum = 0;
	if($tar != null) {
		//affect change of price to cart item
		var pce  = $tar.next().val(),//cache price
			txt  = $t_pce.text();
		$tar.text(pce*qty);//set new item price
	}
	$('li p.price span', elem.$i[0]).each(function() {
		sum += parseInt($(this).text());
	});
	$t_pce.text(sum);
}

function placeOrder(data) {
	$.ajax({
		type: 'POST',
		url: '../../cart/cart.php',
		data: { action: 'checkout', data: data  }
	});
}

function newsletterSubscribe(data){
	$.ajax({
		type: 'POST',
		url: '../../cart/cart.php',
		data: { action: 'submitNewsletter', data: data  }
	});
}

function stayTop(hheight, pos, elem) {
	if(hheight - pos < 0) {
		elem.$m.addClass('fixed');
		elem.$k.addClass('fixed');
		elem.$c.addClass('fixed');
		elem.$f.addClass('fix-pad');
		elem.$n.addClass('fixed-nav');
                elem.$z.addClass('fixed-nav');
	} else {
		elem.$m.removeClass('fixed');
		elem.$k.removeClass('fixed');
		elem.$c.removeClass('fixed');
		elem.$f.removeClass('fix-pad');
		elem.$n.removeClass('fixed-nav');
		elem.$z.removeClass('fixed-nav');
	}	
}