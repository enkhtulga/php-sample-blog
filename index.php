<?php session_start(); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model.php';
require_once 'controllers.php';

$uri = $_SERVER['REQUEST_URI'];
$uri1 = explode("?", $uri);


if('/' == $uri){
	list_action();
} elseif ('/show' == $uri1[0] && isset($_GET['id']) ){
	show_action($_GET['id']);
} elseif('/add' == $uri1[0]){
	add_action();
} elseif('/edit' == $uri1[0] && isset($_GET['id'])){
	edit_action($_GET['id']);
} elseif('/delete' == $uri1[0] && isset($_GET['id'])){
	delete_action($_GET['id']);
} elseif('/author/login' == $uri1[0]){
	author_login();
} elseif('/author/logout' == $uri1[0]){
	author_logout();
} elseif('/author/create' == $uri1[0]){
	author_create();
} elseif('/author/list' == $uri1[0]){
	author_list();
} elseif('/author/delete' == $uri1[0] && isset($_GET['id'])){
	author_delete($_GET['id']);
} elseif('/author/edit' == $uri1[0] && isset($_GET['id'])){
	author_edit($_GET['id']);
}else {
	header('Status: 404 Not found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}

?>
