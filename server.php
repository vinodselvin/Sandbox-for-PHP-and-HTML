<?php
include "./config.php";

error_reporting(0);
$myfile = fopen($_COOKIE['continue'].".php", "w") or die("Unable to open file!");

$txt = "";

if(!empty($_POST['codes'])){
    $txt = "<?php error_reporting(E_ALL); ini_set('display_errors', 1);?>\n";
    $txt .= $_POST['codes'];
}

fwrite($myfile, $txt);
fclose($myfile);

echo json_encode(file_get_contents($config['baseurl'] . $_COOKIE['continue'].".php"));
?>
