<?php
$uas=require('../uas/init.php');
$username = $uas->confirmSession();
if (!$username) {
  exit(header('Location: '.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].'/halfmoon-dashboard/login.html'));
}
$rank = "Normal User";
if ($uas->checkRank(['username'=>$username, 'ranks'=>'admin'])) {
  $rank = "Administrator";
}
?>