<?php
function list_action()
{
	$posts = Post::getAll();
	require 'templates/list.php';
}

function show_action($id)
{
	$post = Post::getById($id);
	require 'templates/show.php';
}

function add_action()
{
	if(isset($_POST['title']) && isset($_POST['content'])){
		$post = new Post();
		$post->_title = $_POST['title'];
		$post->_content = $_POST['content'];
		$post->_date = Date('Y-m-d H:i:s');
		$post->save();
		$location='Location: /';
		header($location);
	}
	else{ require_once 'templates/add.php';}
}

function edit_action($id)
{
	$post = Post::getById($id);
	if(isset($_POST['title']) && isset($_POST['content']))
	{
		$post1 = new Post();
		$post1->_id = $id;
		$post1->_title = $_POST['title'];
		$post1->_content = $_POST['content'];
		$post1->_date = $post->_date;
		$post1->save();
		header('Location: /');
	}
	else{
		require 'templates/edit.php';
	}
}
function delete_action($id)
{
	$post = Post::getById($id);
	$post->delete();
	header('Location: /');
}
?>
