<?php
session_start();

$f3=require(dirname(__FILE__).'/f3/base.php');

$f3->set('AUTOLOAD', dirname(__FILE__).'/models/');

$f3->route('POST /signup', 'apihandler->signup');
$f3->route('POST /login', 'apihandler->login');
$f3->route('POST|GET /logout', 'apihandler->logout');

$action = $f3->get('GET.a');
if (@$action[0] !== '/') {
	$action='/'.$action;
}
$f3->mock($f3->VERB.' '.$action, $_REQUEST);

?>