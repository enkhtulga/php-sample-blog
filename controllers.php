<?php
use base\components\Controller;
use base\components\App;
use UserLoginForm as ULF;
use AuthorCreateForm as ACF;
use AuthorEditForm as AEF;
use AddPostForm as APF;
use base\components\UserIdentity;

class PostController extends Controller
{
    protected function accessRules()
    {
        return [
            static::RULES_COMMON => [
                'authorized'=> true,
            ],
            'List'=>[
                'authorized'=> false,
            ],
            'View'=>[
                'authorized'=> false,
            ],
        ];
    }
    public function actionList()
    {
        $posts = Post::getAll();
        $this->render('templates/list', array('post_list'=> $posts));
    }
    public function actionFilter($by)
    {
        $currentDay = date("Y-m-d");
        $currentWeek = date("W");
        $currentMonth = date("Y-m");

        switch($by){
            case 'day' : $posts = POST::filterBy($currentDay); $filterName = 'day'; break;
            case 'week' : $posts = POST::filterBy($currentWeek); $filterName = 'week'; break;
            case 'month' : $posts = POST::filterBy($currentMonth); $filterName = 'month'; break;
        }
        $this->render('templates/filter', array('posts'=>$posts, 'filterName'=>$filterName));
    }

    function actionView($id)
    {
        $post = Post::getByPk($id);
        $author = Author::getByPk($post->author_id);
        $this->render('templates/show', array('post'=>$post, 'author'=>$author));
    }
    function actionAdd()
    {
        $formCreatePost = new AddPostForm();
        $formData = App::requestPost(null, []);
        if(empty($formData)) {
            $this->layout = '';
            $this->render('templates/add', [
                'formCreatePost' => $formCreatePost,
            ]);
        } else {
            $response = array(
                'success' => false,
            );

            $formCreatePost->setAttributes($formData);
            if($formCreatePost->validate()){
                $response['success'] = true;
                $response['href'] = App::urlFor('');
            } else {
                foreach($formCreatePost->getErrors() as $attributeName => $error) {
                    $response[$attributeName] = $error;
                }
            }
            $this->renderJson($response);
        }
    }
    function actionDelete($id)
    {
        $post = Post::getByPk($id);
        $post->delete();
        header('Location: /');
    }
    function actionEdit($id)
    {
        $formEditPost = new EditPostForm();
        $formData = App::requestPost(null, []);
        $post = Post::getByPk($id);
        if(empty($formData)) {
            $this->layout = '';
            $this->render('templates/edit', [
                'post' => $post,
            ]);
        } else {
            $response = array(
                'success' => false,
            );

            $formEditPost->setAttributes($formData);
            if($formEditPost->validate()){
                $attr =$formEditPost->getAttributes();
                $post->title = $attr['title'];
                $post->content = $attr['content'];
                $post->date = $post->date;
                $post->author_id = $_COOKIE['userId'];
                $post->save();
                $response['success'] = true;
                $response['href'] = App::urlFor('');
            } else {
                foreach($formEditPost->getErrors() as $attributeName => $error) {
                    $response[$attributeName] = $error;
                }
            }
            $this->renderJson($response);
        }
    }
}

class AuthorController extends Controller
{
    protected function accessRules()
    {
        return [
            static::RULES_COMMON => [
                'authorized'=> true,
            ],
            'Login' => [
                'authorized'=> false,
            ],
        ];
    }
    public function actionLogin() {
        $formLogin = new UserLoginForm();
        $formData = App::requestPost(null, []);
        if(empty($formData)) {
            $this->layout = '';
            $this->render('templates/login', [
                'formLogin' => $formLogin,
            ]);
        } else {
            $response = array(
                'success' => false,
            );

            $formLogin->setAttributes($formData);
            if($formLogin->validate()){
                App::sessionStart();
                $author = $formLogin->getAuthor();
                $expire = 0;
                setcookie('userId', $author->id, $expire, '/');
                setcookie('userName', $author->username, $expire, '/');
                setcookie('userToken', $author->getSessionKey($_SERVER['HTTP_USER_AGENT']), $expire, '/');
                $response['success'] = true;
                $response['href'] = App::urlFor('');
            } else {
                foreach($formLogin->getErrors() as $attributeName => $error) {
                    $response[$attributeName] = $error;
                }
            }
            $this->renderJson($response);
        }
    }


    function actionLogout()
    {
        UserIdentity::logout();
        header('Location: /');
    }
    function actionCreate()
    {
        $formCreate = new AuthorCreateForm();
        $formData = App::requestPost(null, []);
        if(empty($formData)) {
            $this->layout = '';
            $this->render('templates/auth_create', [
                'formCreate' => $formCreate,
            ]);
        } else {
            $response = array(
                'success' => false,
            );

            $formCreate->setAttributes($formData);
            if($formCreate->validate()){
                $response['success'] = true;
                $response['href'] = App::urlFor('author/list');
            } else {
                foreach($formCreate->getErrors() as $attributeName => $error) {
                    $response[$attributeName] = $error;
                }
            }
            $this->renderJson($response);
        }
    }
    function actionList()
    {
        $authors = Author::getAll();
        $this->render('templates/auth_list',array('authors'=>$authors));
    }
    function actionDelete($id)
    {
        $author = Author::getByPk($id);
        $author->delete();
        header('Location: /author/list');
    }
    function actionEdit($id)
    {
        $formEditAuthor = new AuthorEditForm();
        $formData = App::requestPost(null, []);
        $author = Author::getByPk($id);
        if(empty($formData)) {
            $this->layout = '';
            $this->render('templates/auth_edit', [
                'author' => $author,
            ]);
        } else {
            $response = array(
                'success' => false,
            );

            $formEditAuthor->setAttributes($formData);
            if($formEditAuthor->validate()){
                $attr =$formEditAuthor->getAttributes();
                $author->name = $attr['name'];
                $author->phone = $attr['phone'];
                $author->username = $attr['username'];
                $author->password = $attr['password'];
                $author->save();
                $response['success'] = true;
                $response['href'] = App::urlFor('author/list');
            } else {
                foreach($formEditAuthor->getErrors() as $attributeName => $error) {
                    $response[$attributeName] = $error;
                }
            }
            $this->renderJson($response);
        }
    }
}

?>
