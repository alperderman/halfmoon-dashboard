<?php
error_reporting(0);
header('Content-Type: application/json');

class api_uas {

  public $uas;

  function __construct() {
    $this->uas = require('../uas/init.php');
  }

  function login() {
    $data = array('status'=>'fail');
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($this->uas->login(["username"=>$username, "password"=>$password])) {
      $data = array('status'=>'success');
    }
    echo json_encode($data);
  }

  function logout($args = []) { //args: redirect
    $this->uas->logout();
    if (empty($args['redirect'])) {$args['redirect'] = null;}
    exit(header('Location: '.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].$args['redirect']));
  }

  function signup() {
    $data = array('status'=>'fail');
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($this->uas->newUser(["username"=>$username, "password"=>$password])) {
      $data = array('status'=>'success');
    }
    echo json_encode($data);
  }

}

$api = new api_uas();
if (!empty($_GET["a"])) {
  $api->{$_GET["a"]}($_GET);
}

?>