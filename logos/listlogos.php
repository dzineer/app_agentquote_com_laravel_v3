<?php
$dir=".";
$files1 = scandir($dir);
#printf("%s", print_r($files1,true));
foreach($files1 as $f) {
#	printf("\n%s/%s", 'https://banner.aq2e.com/logos', $f);
	$cmd = sprintf("wget '%s/%s'", 'http://banner.aq2e.com/logos', $f);
        printf("\n%s", $cmd);
         

}
?>
