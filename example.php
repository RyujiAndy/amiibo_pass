
<?php
$script = "./amiibo_pass ".$_GET['UID'];
$output = shell_exec($script);
echo "<pre>$output</pre>";
?>

