<?php $title= "Edit author information" ?>
<?php ob_start() ?>
<form class="form-horizontal" role="form" action='' method="POST">
  <div class="form-group">
    <label for="updateName" class="col-sm-2 control-label">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value = "<?php echo $author->name; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="updatePhone" class="col-sm-2 control-label">Phone:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="phone" value = "<?php echo $author->phone; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="updateUsername" class="col-sm-2 control-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" value = "<?php echo $author->username; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="updatePassword" class="col-sm-2 control-label">Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="password" value = "<?php echo $author->password; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-9 col-sm-10">
      <button type="submit" class="btn btn-primary" name="submit">Update</button>
      <a href="/author/list" class="btn btn-defualt">Back</a>
    </div>
  </div>
</form>
<?php $content=ob_get_clean() ?>
<?php require 'layout.php' ?>
