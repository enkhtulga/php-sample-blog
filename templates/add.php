<?php $title="Add new post"; ?>
<?php ob_start() ?>
<form class="form-horizontal" role="form" action="" method="POST" >
	<div class="form-group">
		<label for="inputTitle" class="col-sm-2 control-label">Title</label>
		<div class="col-sm-10">	
			<input type="text" class="form-control" placeholder="Enter title" name ='title'>
		</div>
	</div>
	<div class="form-group">
		<label for="inputContent" class="col-sm-2 control-label">Content</label>
		<div class="col-sm-10">
			<textarea class="form-control" row="3" name ='content' placeholder="Enter content"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">		
			<button type="submit" class="btn btn-default" name='submit'>Post</button>
		</div>
	</div>
</form>
<?php  $content=ob_get_clean(); ?>
<?php include 'layout.php' ?>
