<!DOCTYPE html>
<html lang="en" ng-app="blog">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Signin Template for Bootstrap</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container" ng-controller="ErrorController">

      <form id="lForm" class="form-signin login-form" role="form" action="" method="POST">
        <h2 class="form-signin-heading">Please login </h2>
        <div class="alert fade in alert-danger" ng-if="errorMsg">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{errorMsg['username']}}{{ errorMsg['password']}}
        </div>
        <input type="username" name="username" class="form-control" placeholder="Username" required autofocus/>
        <input type="password" name="password" class="form-control" placeholder="Password" required/>
        <input value="Login" class="btn btn-lg btn-primary btn-block" type="submit" ng-click="setMsg()"/>
	<a href="/">back to Home page</a>
      </form>

    </div>
  </body>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/angular.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
</html>
