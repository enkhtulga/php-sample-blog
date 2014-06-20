<!DOCTYPE html>
<html lang="en" ng-app="blog">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/blog.css" rel="stylesheet">
</head>

<body>
    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="/">Home</a>
		        <?php if(isset($_COOKIE['userId'])){ ?>
			        <a class="blog-nav-item" href="/post/add">New post</a>
			        <a class="blog-nav-item" href="/author/create">Create author</a>
                    <a class="blog-nav-item" href="/author/list">Authors</a>
                    <p class="blog-nav-item"><?php echo "Welcome,".$_COOKIE['userName'] ?></p>
                    <a class="blog-nav-item" href="/author/logout?cond=1">Logout</a>
                <?php } else { ?>
                        <a class="blog-nav-item" href="/author/login">Login</a>
                <?php } ?>
            </nav>
        </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">PHP Sample blog</h1>
        <p class="lead blog-description">The official example code of creating a blog with Bootstrap.</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          <div class="blog-post" ng-controller="ErrorController">
            <h2 class="blog-post-title"><?php echo $title ?></h2>


            <p><?php echo $content ?></p>

          </div><!-- /.blog-post -->


        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module">
            <ol class="sidebar-module sidebar-module-inset list-unstyled">
            <h4>Filter by</h4>
            <li><a href="/post/filter?by=<?php echo "day"; ?>">Today</a></li>
            <li><a href="/post/filter?by=<?php echo "week"; ?>">This week</a></li>
            <li><a href="/post/filter?by=<?php echo "month"; ?>">This month</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Дээшлэх</a>
      </p>
    </div>


    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/angular.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
  </body>
</html>

