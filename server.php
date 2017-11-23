<?php
include "./config.php";

$myfile = fopen("output.php", "w") or die("Unable to open file!");

$txt = "<?php error_reporting(E_ALL); ini_set('display_errors', 1);?>\n";

$txt .= $_POST['codes'];

fwrite($myfile, $txt);
fclose($myfile);

echo json_encode(file_get_contents($config['baseurl'] . "output.php"));
?>
