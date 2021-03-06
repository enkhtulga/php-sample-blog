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
	static function getBy($inputValues)
	{
		$link = open_database_connection();
		$col = '';
		$strFields = implode(',',static::$fields);
		foreach($inputValues as $i=>$value){
			$col .=static::$fields[$i].'="'.$value.'" AND ';
		}
		$col = substr($col, 0, strlen($col)-5);
		$query = "SELECT %s FROM %s WHERE %s";
		$sql = sprintf($query, $strFields, static::$table, $col);
		$result = mysqli_query($link, $sql) or die(mysql_error());
		$className = get_called_class();
		$row = mysqli_fetch_assoc($result);
		$obj = new $className;
		foreach(static::$fields as $field)
			$obj->$field = $row[$field];
		close_database_connection($link);
		return $obj;
	}
	static function getAll()
	{
		$link = open_database_connection();
		$strFields = implode(',', static::$fields);
		$query = "SELECT %s FROM %s";
		$sql = sprintf($query, $strFields, static::$table);
		$result = mysqli_query($link, $sql) or die(mysql_error());
		$className = get_called_class();
		$obj_collection = array();
		while($row = mysqli_fetch_assoc($result)){
			$tableResult = new $className();
			foreach(static::$fields as $field)
				$tableResult->$field = $row[$field];
			$obj_collection[] = $tableResult;
		}
		close_database_connection($link);
		return $obj_collection;
	}
	public function save()
	{
		$link = open_database_connection();
		if($this->id == ''){
			$strValues = '';
			foreach(static::$fields as $field)
				$strValues .= '"'.$this->$field.'",';
			$strFields = implode(',', static::$fields);
			$strValues = substr($strValues, 0, strlen($strValues)-1);
			$query = "INSERT INTO %s (%s)
					VALUES(%s)";
			$sql = sprintf($query, static::$table, $strFields, $strValues);
			$result = mysqli_query($link, $sql);
		}
		else{
			$col = '';
			foreach(static::$fields as $field)
				$col .= $field.'="'.$this->$field.'",';
			$col = substr($col, 0, strlen($col)-1);
			$query = "UPDATE %s
					SET %s
				WHERE id = $this->id";
			$sql = sprintf($query, static::$table, $col);
			$result = mysqli_query($link, $sql);
	
		}
		close_database_connection($link);
	}
	public function delete()
	{
		$link = open_database_connection();
		$id = intval($this->id);
		$query = "DELETE
			FROM %s
			WHERE id = '$id'";
		$sql = sprintf($query, static::$table);
		$result = mysqli_query($link, $sql);
		close_database_connection($link);
	}
}

class Post extends Model
{
	public $id;
	public $title;
	public $content;
	public $date;
	public $author_id;
	
	static $fields = array(
				'id'=>'id',
				'title'=>'title',
				'content'=>'content',
				'date'=>'date',
				'author_id'=>'author_id',
				);
	static $table = 'Post';
}
class Author extends Model
{
	public $id;
	public $name;
	public $phone;
	public $username;
	public $password;

	static $fields = array(
				'id'=>'id',
				'name'=>'name',
				'phone'=>'phone',
				'username'=>'username',
				'password'=>'password',
				);
	static $table = 'Author';
}
?>
