<?php
use base\components\Controller;
use base\components\App;
use UserLoginForm as ULF;
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

    function actionView($id)
    {
        $post = Post::getByPk($id);
        $author = Author::getByPk($post->author_id);
        $this->render('templates/show', array('post'=>$post, 'author'=>$author));
    }
    function actionAdd()
    {
        if(isset($_POST['title']) && isset($_POST['content'])){
            $post = new Post();
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->date = Date('Y-m-d H:i:s');
            $post->author_id = $_COOKIE['userId'];
            $post->save();
            $location='Location: /';
            header($location);
        }
        else{
            $this->render('templates/add');
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
        $post = Post::getByPk($id);
        if(isset($_POST['title']) && isset($_POST['content']))
        {
            $post->id = intval($id);
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->date = $post->date;
            $post->author_id = $_SESSION['userId'];
            $post->save();
            header('Location: /');
        }
        else{
            $this->render('templates/edit', array('post'=>$post));
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
                header('Location: /');
            } else {
                $response['msg'] = 'Invalid request:<br/>';
                foreach($formLogin->getErrors() as $attributeName => $error) {
                    $response['msg'] .= "$attributeName: $error<br/>";
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
        if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $author = new Author();
            $author->name = $_POST['name'];
            $author->phone = $_POST['phone'];
            $author->username = $_POST['username'];
            $author->password = $_POST['password'];
            $author->save();
            header('Location: /author/list');
        }
        else $this->render('templates/auth_create');
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
        $author = Author::getByPk($id);
        if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])){
            $author->id = intval($id);
            $author->name = $_POST['name'];
            $author->phone = $_POST['phone'];
            $author->username = $_POST['username'];
            $author->password = $_POST['password'];
            $author->save();
            header('Location: /author/list');
        }else $this->render('templates/auth_edit',array('author'=>$author));
    }
}

?>
