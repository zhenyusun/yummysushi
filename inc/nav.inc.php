<?php //pos abs into padding/margin of header 
$cur = "";
?>
			<div id="nav" class="white">
				<ul>

				<?php 
					foreach($category->getCountImagesForCategories() as $cats):
						if ($cats->totalimage > 0):
                                                    //for removing the (12:00 - 16:00 from headline for frokost)
                                                    if(strpos($cats->ca_name,"(")){
                                                        $categoryname_array = explode ("(", $cats->ca_name);
                                                        $categoryname = $categoryname_array[0];
                                                    }else{
                                                        $categoryname = $cats->ca_name;
                                                    }
				?>
						<li><a href="<?php echo $cats->ca_url ?>" <?php if($cats->ca_url == $cur) echo 'id="current"' ?> class="white"><span><?php echo $categoryname ?></span></a></li>

				<?php
						endif;
					endforeach;?>

				</ul>
			</div>
			
			

