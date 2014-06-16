<?PHP
require 'base/components/Model.php';
require 'base/components/CacheProvider.php';
require 'base/components/Cache.php';

//require 'config/local_settings.php';
//$link = mysqli_connect($db_host, $db_username, $db_password, $db_name);
//mysqli_query($link, "SET NAMES 'UTF8'");

base\components\CacheProvider::init([]);

function close_database_connection($link)
{
	mysqli_close($link);
}

class Post extends base\components\Model
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
}
//Post::setConnection($link);

class Author extends base\components\Model
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
        //var_dump(password_verify($this->toString() . $additionalParams, $key)); die();
        return password_verify($this->toString() . $additionalParams, $key);
    }

}
?>
