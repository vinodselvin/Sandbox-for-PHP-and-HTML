<?php
include "./config.php";

/*if(empty($_COOKIE['continue'])){
    setcookie('continue', uniqid().rand(10,5000), time() + (86400 * 300), "/"); // 86400 = 1 day
}*/
error_reporting(0);
$myfile = fopen($_COOKIE['continue'].".php", "w") or die("Unable to open file!");

$txt = "<?php error_reporting(E_ALL); ini_set('display_errors', 1);?>\n";

$txt .= $_POST['codes'];

if(empty($_POST['codes'])){
    $txt = "";
}

fwrite($myfile, $txt);
fclose($myfile);

echo json_encode(file_get_contents($config['baseurl'] . $_COOKIE['continue'].".php"));
?>
