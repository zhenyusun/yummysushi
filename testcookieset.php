<?php
//set test cookies manually
$str = 'name=menu-code-foo?price=666?path=include/images/menu-code-foo.jpg?';

//add cookie
//setcookie('sushi_menu-code-foo', $str, time() + 3600*24,'/');

//remove cookie
//setcookie ('sushi_menu-code-foo', '', time() - 3600, '/');
print_r($_COOKIE);