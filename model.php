<?php

function open_database_connection()
{
	require 'local_settings.php';
	$link = mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db($db_name, $link);
	mysql_query("SET NAMES 'UTF8'", $link);
	return $link;
}

function close_database_connection($link)
{
	mysql_close($link);
}

function get_all_post_by_newer()
{
	$link = open_database_connection();
	
	$query = '
		SELECT
			Post.id as id,
			Post.title,
			Post.content,
			Post.date,
			Author.name
		FROM Post
		INNER JOIN Author
		WHERE Post.author = Author.id
		ORDER BY date DESC
	';
	$result = mysql_query($query, $link) or die(mysql_error());

	$posts = array();
	while($row = mysql_fetch_assoc($result)){
		$posts[] = $row;
	}
	
	close_database_connection($link);

	return $posts;
}

function get_post_by_id($id)
{
	$link = open_database_connection();

	$id = intval($id);
	$query = 'SELECT
				Post.id AS id,
				Post.date AS date,
				Post.title, 
				Post.content, 
				Author.name as author 
			  FROM Post INNER JOIN Author
			  ON Post.author = Author.id 
			  WHERE Post.id ='.$id;

	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);

	close_database_connection($link);
	
	return $row;
}

function edit_post($id, $title, $content, $date)
{
	$link = open_database_connection();
	$id = intval($id);
	$query = "UPDATE Post
			SET title = '$title',
			content = '$content',
			date = '$date'
		WHERE id = $id";
	$result = mysql_query($query);

	close_database_connection($link);
}
?>

