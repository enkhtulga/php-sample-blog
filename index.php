<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model.php';
require_once 'controllers.php';

$uri = $_SERVER['REQUEST_URI'];
$uri1 = explode("?", $uri);


if('/index.php' == $uri){
	list_action();
} elseif ('/index.php/show' == $uri1[0] && isset($_GET['id']) ){
	show_action($_GET['id']);
} elseif('/index.php/add' == $uri1[0]){
	add_action();
} elseif('/index.php/edit' == $uri1[0] && isset($_GET['id'])){
	edit_action($_GET['id']);
} elseif('/index.php/delete' == $uri1[0] && isset($_GET['id'])){
	delete_action($_GET['id']);
}
  else {
	header('Status: 404 Not found');
	echo '<html><body><h1>Page Not Found1</h1></body></html>';
}

?>
