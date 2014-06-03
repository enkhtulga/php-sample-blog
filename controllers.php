<?php
function list_action()
{
	$posts = Post::getAll();
	require 'templates/list.php';
}

function show_action($id)
{
	$post = Post::getById($id);
	$author = Author::getById($post->author);
	require 'templates/show.php';
}

function add_action()
{
	if(isset($_POST['title']) && isset($_POST['content'])){
		$post = new Post();
		$post->title = $_POST['title'];
		$post->content = $_POST['content'];
		$post->date = Date('Y-m-d H:i:s');
		$post->author = $_SESSION['userId'];
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
		$post->author = $_SESSION['userId'];
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

function author_login()
{
	$authors = Author::getAll();
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		foreach($authors as $author)
		{
			if($author->username == $_POST['username'] && $author->password == $_POST['password']){
				$_SESSION['currentUser'] = $author->username;
				$_SESSION['userId'] = $author->id;
				header('Location: /');
			}
			else{
				header('Location: /author/login');
			}
		}
	}
	else{
		require 'templates/login.php';
	}
}
function author_logout()
{
	session_destroy();
	header('Location: /');
}
function author_create()
{
	if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$author = new Author();
		$author->name = $_POST['name'];
		$author->phone = $_POST['phone'];
		$author->username = $_POST['username'];
		$author->password = $_POST['password'];
		$author->save();
		header('Location: /');
	}
	else{
		require 'templates/auth_create.php';
	}
}
function author_list()
{
	$authors = Author::getAll();
	require 'templates/auth_list.php';
}
function author_delete($id)
{
	$author = Author::getById($id);
	$author->delete();
	header('Location: /author/list');
}
function author_edit($id)
{
	$author = Author::getById($id);
	if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])){
		$author->id = intval($id);
		$author->name = $_POST['name'];
		$author->phone = $_POST['phone'];
		$author->username = $_POST['username'];
		$author->password = $_POST['password'];
		$author->save();
		header('Location: /author/list');
	}else {
		require 'templates/auth_edit.php';
	}
}
?>
