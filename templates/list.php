<?php $title = 'List of Posts' ?>

<?php ob_start() ?>
	<ul>
		<?php foreach($posts as $post): ?>
		<li>
			<a href="/show?id=<?php echo $post->_id; ?>">
				<?php echo $post->_title; ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>

