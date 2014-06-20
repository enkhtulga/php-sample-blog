<?php
use base\components\Model;
use base\components\CacheProvider;

CacheProvider::init([]);

class Post extends Model
{
	static protected $_table = 'Post';
	static protected $_fields = array(
        'id'=> array(
            'type'=> 'i',
            'rule'=> self::RULE_NONE
        ),
		'title'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
		'content'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
		'date'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
		'author_id'=> array(
            'type'=>'i',
            'rule'=> self::RULE_ALL
        ),
    );
    public static function filterBy($filter){
        $fields = POST::getAttributeNames();
        $like = '%';
        if($filter==date("W")){
            $query = "SELECT id, title, content, date, author_id
                    FROM %s
                    WHERE WEEK(date,1)=$filter
                    ORDER BY date DESC";
        }
        else{
            $query = "SELECT id, title, content, date, author_id
                    FROM %s
                    WHERE date LIKE '$filter%s'
                    ORDER BY date DESC";
        }
		$sql = sprintf($query, static::$_table, $like);
        $result = mysqli_query(static::$_connection, $sql) or die(mysql_error());
		$obj = array();
		while($row = mysqli_fetch_assoc($result)){
			$obj[] = $row;
		}
        return $obj;
    }
}

class Author extends Model
{
	static protected $_table = 'Author';
	static protected $_fields = array(
		'id'=> array(
            'type'=> 'i',
            'rule'=> self::RULE_NONE
        ),
		'name'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
		'phone'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
		'username'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        ),
        'password'=> array(
            'type'=> 's',
            'rule'=> self::RULE_ALL
        )
    );
    private function toString($addUniqueId = false, $addAuthKey = false) {
        $result = '';
        foreach($this->_values as $field => &$attr) {
            if((($field === 'auth_key' && $addAuthKey) || $field !== 'auth_key') && isset($attr)) {
                $result .= $attr;
            }
        }
        if($addUniqueId) {
            $result .= uniqid();
        }
        return $result;
    }

    public function getSessionKey($additionalParams = '') {
        return password_hash($this->toString() . $additionalParams, PASSWORD_BCRYPT);
    }

    public function checkSessionKey($key, $additionalParams = '') {
        return password_verify($this->toString() . $additionalParams, $key);
    }
}
?>
