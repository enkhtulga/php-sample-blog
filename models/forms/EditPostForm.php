<?php
use base\components\Form;
use models\model;

class EditPostForm extends Form
{
    public $title;
    public $content;

    protected function rules(){
        return [
            'title' => [
                'type' => 'string',
                'lengthMax' => '50',
                'lengthMin' => '1',
                'required' => 'true',
            ],
            'content' => [
                'type' => 'string',
                'lengthMin' => '5',
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


