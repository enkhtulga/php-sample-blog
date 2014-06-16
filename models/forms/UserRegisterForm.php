<?php
class UserRegisterForm extends base\components\Form {
    public $username;
    public $password;
    public $passwordConfirm;
    public $timezone;
    public $terms;
    public $csrfToken;

    protected function rules() {
        return [
            'username' => [
                'type' => 'string',
                'lengthMax' => 32,
                'lengthMin' => 1,
                'required' => true,
            ],
            'password' => [
                'type' => 'string',
                'required' => true,
            ],
            'passwordConfirm' => [
                'type' => 'string',
                'required' => true,
            ],
            'email' => [
                'type' => 'string',
                'lengthMax' => 64,
                'email' => true,
                'required' => true,
            ],
            'timezone' => [
                'type' => 'int',
                'valueMin' => -12,
                'valueMax' => 12,
                'required' => true,
            ],
            'terms' => [
                'type' => 'bool',
                'required' => true,
            ],
        ];
    }
}
