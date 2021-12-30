<?php

class apihandler {

  public $handler;

  function __construct() {
    $this->handler = new handler();
  }

  function login($f3) {
    header('Content-Type: application/json');
    $data = array('status'=>'fail');
    $username = $f3->get("POST.username");
    $password = $f3->get("POST.password");
    if ($this->handler->login($f3, $username, $password)) {
        $data = array('status'=>'success');
    }
    echo json_encode($data);
  }

  function logout($f3) {
    $this->handler->logout($f3);
    exit(header('Location: '.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].'/halfmoon-dashboard/login.html'));
  }

  function signup($f3) {
    header('Content-Type: application/json');
    $data = array('status'=>'fail');
    $username = $f3->get("POST.username");
    $password = $f3->get("POST.password");
    if ($this->handler->signup($f3, $username, $password)) {
        $data = array('status'=>'success');
    }
    echo json_encode($data);
  }

}

?>