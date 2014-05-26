<?php $title = $post['title'] ?>

<?php ob_start() ?>
	
<p class="blog-post-meta"><?php echo $post['date'] ?> by <?php echo $post['author'] ?><a href="/index.php/edit?id=<?php echo $post['id'] ?>">  Edit post</a><a href="/index.php/delete?id=<?php $post['id'] ?>" class="btn btn-danger">Delete post</a></p>
	<div class ="body text-justify">
		<?php echo $post['content'] ?>
	</div>
<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>
