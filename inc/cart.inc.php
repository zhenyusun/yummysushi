<?php
/*
* Cart is dynamic - this needs to be used to
* for no-JS compatibility at a later date
*/
?>

<div id="cart">
	<ul>
		<li id="cart-menu-code-foo-125"><?php /*clone and insert new for ajax cart*/ ?>
			<img src="include/images/menu-one_sm.jpg" />
			<div class="cart-detail">
				<strong>Product Title</strong>
				<div class="qty-detail">
					<input type="text" />
					<div class="controls">
						<a class="plus">+</a>
						<a class="minus">-</a>
						
					</div><!-- end .controls -->
					<p><span>1</span> stk</p>
					<a class="remove">Remove</a>
				</div><!-- end .qty-detail -->
			</div><!-- end .cart-detail -->
		</li>
		
		<li id="cart-menu-code-bar-250" class="last"><?php /*clone and insert new for ajax cart*/ ?>
			<img src="include/images/menu-two_sm.jpg" />
			<div class="cart-detail">
				<strong>Product Title</strong>
				<div class="qty-detail">
					<input type="text" />
					<div class="controls">
						<a class="plus">+</a>
						<a class="minus">-</a>
						
					</div><!-- end .controls -->
					<p><span>1</span> stk</p>
					<a class="remove">Remove</a>
				</div><!-- end .qty-detail -->
			</div><!-- end .cart-detail -->
		</li>
	</ul>
</div><!-- end #cart -->
