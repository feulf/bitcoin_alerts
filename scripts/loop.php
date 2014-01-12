<?php

do {

echo "-" .  date(DATE_RFC2822) . "\n";
echo exec("php check.php");
echo "\n";
sleep(5);

} while (1==1);
