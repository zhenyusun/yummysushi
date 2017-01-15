<?php 
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";    
            $headers .= "from:info@yummysushi.dk";
            $subject = "Welcome to yummysushi";

echo "test send emails";
  mail("zhenyu@rosemunde.com, zhenyu_1984@yahoo.dk, zhenyu@bamboo-solution.dk", "test from php 16.56", "just a test", $headers);
?>
