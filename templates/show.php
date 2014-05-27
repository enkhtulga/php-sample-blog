<?php $title = $post['title'] ?>

<?php ob_start() ?>
	
	<p class="blog-post-meta"><?php echo $post['date'] ?> by <?php echo $post['author'] ?>
		<a href="/edit?id=<?php echo $post['id'] ?>" class="btn btn-warning btn-sm">  Edit post</a>
		<a href="/delete?id=<?php echo $post['id'] ?>" class="btn btn-danger btn-sm">  Delete post</a>
	</p>
	<div class ="body text-justify">
		<?php echo $post['content'] ?>
	</div>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
