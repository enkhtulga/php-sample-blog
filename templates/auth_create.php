<?php $title="Create new author"; ?>
<?php ob_start() ?>
<form class="form-horizontal" role="form" action="" method="POST" >
	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">Name:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Write your name" name ="name" required>
		</div>
	</div>
	<div class="form-group">
		<label for="inputPhone" class="col-sm-2 control-label">Phone:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" row="3" name ='phone' placeholder="Write phone number"/>
		</div>
	</div>

	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" row="3" name ="username" placeholder="Write username" required/>
		</div>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password:</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" row="3" name ="password" placeholder="Write password"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default" name='submit'>Create</button>
		</div>
	</div>
</form>
<?php  $content=ob_get_clean(); ?>
<?php include 'layout.php' ?>
