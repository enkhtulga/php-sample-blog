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
	static function getById($id)
	{
		$link = open_database_connection();
		$id = intval($id);
		$query = 'SELECT id, date, title, content
			FROM Post 
			WHERE id = '.$id;
		$result = mysqli_query($link, $query);
		$className = get_called_class();
		while($row = mysqli_fetch_assoc($result)){
			$currentPost = new $className();

			$currentPost->_id = $row['id'];
			$currentPost->_title = $row['title'];
			$currentPost->_content = $row['content'];
			$currentPost->_date = $row['date'];
		}

		close_database_connection($link);
		return $currentPost;
	}
	static function getAll()
	{
		$strFields='';
		$link = open_database_connection();

		$strFields = implode(',', static::$fields);
		
		$query = "SELECT %s FROM %s ORDER BY date DESC";
		$sql = sprintf($query, $strFields, static::$table);

		$result = mysqli_query($link, $sql) or die(mysql_error());
		$className = get_called_class();
		$obj_collection = array();
		while($row = mysqli_fetch_assoc($result)){
			$tableResult = new $className();
			foreach($tableResult as $i=>$field)
				$tableResult->$i = $row[$i];
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
	public $id;
	public $title;
	public $content;
	public $date;
	
	static $fields = array('id', 'title', 'content', 'date');
	function call(){
		foreach(static::$fields as $key => $value){
			echo "Key: $key; Value: $value\n";
		}
	}	
	static $table = 'Post';
}
?>
