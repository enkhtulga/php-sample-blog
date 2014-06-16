<?php $title = 'List of Posts'; ?>

<?php ob_start() ?>
	<ul>
		<?php foreach($post_list as $post): ?>
		<li>
			<a href="/post/view?id=<?php echo $post->id; ?>">
                <?php echo $post->title; ?>
			</a>
        </li>
		<?php endforeach ?>
    </ul>
    <ul class="pagination">
        <?php for($i=1; $i<= count($post_list)/3; $i++){
        if($i==1){ ?>
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
        <?php }else { ?>
            <li><a href="#"><?php echo $i; ?></a></li>
        <?php }} ?>
    </ul>
<?php $content = ob_get_clean() ?>
<?php include 'layout.php' ?>

