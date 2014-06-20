<?php
use base\components\Form;
use models\model;

class UserLoginForm extends Form
{
    public $username;
    public $password;
    private $_author;

    protected function rules(){
        return [
            'username' => [
                'type' => 'string',
                'lengthMax' => '32',
                'lengthMin' => '3',
                'required' => 'true',
            ],
            'password' => [
                'type' => 'string',
                'lengthMin'=> '3',
                'required' => 'true',
            ],
        ];
    }

    public function getAuthor(){
        return $this->_author;
    }

    public function validate(){
        if(!parent::validate()){
            return false;
        }

        $author = Author::getBy(array(
            'username'=> trim($this->username)
        ));

        if(!$author instanceof Author){
            $this->_errors['username']='Incorrect username.';
            return false;
        }

        if($this->password != $author->password){
            $this->_errors['password']='Incorrect password.';
            return false;
        }

        $this->_author = $author;
        return true;
    }
}
?>
