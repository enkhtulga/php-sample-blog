<?php
use base\components\Form;
use models\model;

class AddPostForm extends Form
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

        $post = new Post();
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->date = Date('Y-m-d H:i:s');
        $post->author_id = $_COOKIE['userId'];
        $post->save();
        return true;
    }
}
?>

