<?php
function list_action()
{
	$posts = get_all_post_by_newer();
	require 'templates/list.php';
}

function show_action($id)
{
	$post = get_post_by_id($id);
	require 'templates/show.php';
}

function add_action()
{
	if(isset($_POST['title']) && isset($_POST['content'])){
		$input_title = $_POST['title'];
		$input_content = $_POST['content'];
		$input_date = Date('Y-m-d H:i:s');
		$post = add_post($input_title, $input_content, $input_date);
		$location='Location: /index.php';
		header($location);
	}
	else{ require_once 'templates/add.php';}
}

function edit_action($id)
{
	$post = get_post_by_id($id);
	if(isset($_POST['title']) && isset($_POST['content']))
	{
		$title = $_POST['title'];
		$content = $_POST['content'];
		$date = $post['date'];
		$post = edit_post($id, $title, $content, $date);
		header('Location: /index.php');
	}
	else{
		require 'templates/edit.php';
	}
}
function delete_action($id)
{
	$post = delete_post($id);
	header('Location: /index.php');
}
?>
