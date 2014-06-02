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
		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->date = Date('Y-m-d H:i:s');
		$post->author = 1;

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
		$post->id = intval($id);
		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->date = $post->date;
		$post->author = 1;
		$post->save();
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
