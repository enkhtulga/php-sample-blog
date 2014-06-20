<?php $title="Add new post"; ?>
<?php ob_start() ?>
<form class="form-horizontal" id="lForm" action="" method="POST" >
    <div class="alert fade in alert-danger" ng-if="errorMsg['title']">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{errorMsg['title']}}
    </div>
	<div class="form-group">
		<label for="inputTitle" class="col-sm-2 control-label">Title</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Enter title" name ='title' required>
		</div>
	</div>
    <div class="alert fade in alert-danger" ng-if="errorMsg['content']">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{errorMsg['content']}}
    </div>
	<div class="form-group">
		<label for="inputContent" class="col-sm-2 control-label">Content</label>
		<div class="col-sm-10">
			<textarea class="form-control" row="3" name ='content' placeholder="Enter content" required></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default" name='submit' id="submit" ng-click="setMsg()">Create post</button>
		</div>
	</div>
</form>
<?php  $content=ob_get_clean(); ?>
<?php include 'layout.php' ?>
