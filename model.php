<?php

function open_database_connection()
{
	$link = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('Sample_blog', $link);
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
				Post.date, 
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

?>

