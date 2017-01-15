<?php 
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


?>
<?php headdocs();?>
    <body>
        
        <?php newsletter();?>
        
<?php include('inc/nav.inc.php'); ?>
		<?php /*<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> */ ?>
		<script type="text/javascript" src="include/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="include/js/pbsushi.js"></script>
		
    </body>
</html>