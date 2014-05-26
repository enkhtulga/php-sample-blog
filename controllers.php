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
?>
