<?php

function open_database_connection()
{
	require 'local_settings.php';
	$link = mysqli_connect($db_host, $db_username, $db_password, $db_name);
	mysqli_query($link, "SET NAMES 'UTF8'");
	return $link;
}

function close_database_connection($link)
{
	mysqli_close($link);
}

class Model
{
	public $_id;
	public $_title;
	public $_content;
	public $_date;
	public $_author;
	
	static function getById($id)
	{
		$link = open_database_connection();
		$id = intval($id);
		$query = 'SELECT
					Post.id As id,
					Post.date AS date,
					Post.title AS title,
					Post.content AS content,
					Author.name AS author
				FROM Post INNER JOIN Author
				ON Post.author = Author.id
				WHERE Post.id = '.$id;
		$result = mysqli_query($link, $query);
		$className = get_called_class();
		while($row = mysqli_fetch_assoc($result)){
			$currentPost = new $className();

			$currentPost->_id = $row['id'];
			$currentPost->_title = $row['title'];
			$currentPost->_content = $row['content'];
			$currentPost->_date = $row['date'];
			$currentPost->_author = $row['author'];
		}

		close_database_connection($link);
		return $currentPost;
	}
	static function getAll()
	{
		$link = open_database_connection();
		$query = 'SELECT
				Post.id as id,
				Post.title as title,
				Post.content as content,
				Post.date as date,
				Author.name as author
			FROM Post INNER JOIN Author
			WHERE Post.author = Author.id
			ORDER BY date DESC';
		$result = mysqli_query($link, $query) or die(mysql_error());
		$className = get_called_class();
		$obj_collection = array();

		while($row = mysqli_fetch_assoc($result)){
			$tableResult = new $className();
			$tableResult->_id = $row['id'];
			$tableResult->_title = $row['title'];
			$tableResult->_content = $row['content'];
			$tableResult->_date = $row['date'];
			$obj_collection[] = $tableResult;
		}
		close_database_connection($link);
		return $obj_collection;
	}
	public function save()
	{
		if($this->_id == ''){
			$link = open_database_connection();
			$query = "INSERT INTO Post
				VALUES(NULL,
					'$this->_title',
					'$this->_content',
					'$this->_date',
					1)";
			$result = mysqli_query($link, $query);
			close_database_connection($link);
		}
		else{
			$link = open_database_connection();
			$id = intval($this->_id);
			$query = "UPDATE Post
					SET title = '$this->_title',
					content = '$this->_content',
					date = '$this->_date'
				WHERE id = '$this->_id'";
			$result = mysqli_query($link, $query);
	
			close_database_connection($link);
		}
	}
	public function delete()
	{
		$id = intval($this->_id);
		$link = open_database_connection();
		$query = "DELETE
			FROM Post
			WHERE id = '$id'";
		$result = mysqli_query($link, $query);
		close_database_connection($link);
	}
}

class Post extends Model
{
}
?>

