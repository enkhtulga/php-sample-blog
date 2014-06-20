<?php
use base\components\Form;
use models\model;

class AuthorCreateForm extends Form
{
    public $name;
    public $phone;
    public $username;
    public $password;

    protected function rules(){
        return [
            'name' => [
                'type' => 'string',
                'lengthMax' => '32',
                'lengthMin' => '2',
            ],
            'username' => [
                'type' => 'string',
                'lengthMax' => '32',
                'lengthMin' => '3',
                'required' => 'true',
            ],
            'password' => [
                'type' => 'string',
                'required' => 'true',
            ],
        ];
    }

    public function validate(){
        if(!parent::validate()){
            return false;
        }

        $author = new Author();
        $author->name = $_POST['name'];
        $author->phone = $_POST['phone'];
        $author->username = $_POST['username'];
        $author->password = $_POST['password'];
        $author->save();
        return true;
    }
}
?>
