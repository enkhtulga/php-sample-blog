<?php $title = 'List of Authors' ?>

<?php ob_start() ?>
<table class="table table-hover">
<thead>
	<tr>
		<th>Author name</th>
		<th>Phone</th>
		<th>Username</th>
		<th>Password</th>
		<th>Actions</th>
	</tr>
</thead>
<?php foreach($authors as $author){ ?>
	<tbody>
		<tr>
			<td><?php echo $author->name ?></td>
			<td><?php echo $author->phone ?></td>
			<td><?php echo $author->username ?></td>
			<td><?php echo $author->password ?></td>
			<td>
				<a class="btn btn-primary btn-xs" href="/author/edit?id=<?php echo $author->id; ?>">Edit</a>
				<a class="btn btn-danger btn-xs" href="/author/delete?id=<?php echo $author->id ?>">Delete</a>
			</td>
		</tr>
	</tbody>
<?php } ?>
</table>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>

