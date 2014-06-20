<?php $title = "Filtered by $filterName"; ?>

<?php ob_start();?>
    <ul><?php if(!empty($posts)){ ?>
            <?php foreach($posts as $post){ ?>
            <li>
                <a href="/post/view?id=<?php echo $post['id']; ?>">
                    <?php echo $post['title']; ?>
                </a>
            </li>
            <?php } ?>
        <?php }else{ echo "<p>Sorry, There are no posts for $filterName.</p>"; } ?>
    </ul>

<?php $content = ob_get_clean() ?>

<?php include 'layout.php' ?>

