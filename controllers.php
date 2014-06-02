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
		$post->id = "NULL";
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
		$post1 = new Post();
		$post1->id = intval($id);
		$post1->title = $_POST['title'];
		$post1->content = $_POST['content'];
		$post1->date = $post->date;
		$post1->author = 1;
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
