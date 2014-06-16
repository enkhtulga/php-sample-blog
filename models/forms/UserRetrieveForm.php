<?php
class UserRetrieveForm extends base\components\Form {
    public $email;
    public $csrfToken;

    protected function rules() {
        return [
            'email' => [
                'required' => true,
                'type' => 'string',
                'email' => true
            ]
        ];
    }

}
