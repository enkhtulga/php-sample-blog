<?php
use base\components\Form;
use models\model;

class AuthorEditForm extends Form
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
            'phone' => [
                'type' => 'string',
            ],
            'username' => [
                'type' => 'string',
                'lengthMax' => '32',
                'lengthMin' => '3',
                'required' => 'true',
            ],
            'password' => [
                'type' => 'string',
                'lengthMin' => '3',
                'required' => 'true',
            ],
        ];
    }

    public function validate(){
        if(!parent::validate()){
            return false;
        }
        return true;
    }
}
?>
