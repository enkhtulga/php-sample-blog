<?php $title= "Edit post" ?>
<?php ob_start() ?>
<form class="form-horizontal" id="lForm" action='' method="POST">
    <div class="alert fade in alert-danger" ng-if="errorMsg['title']">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{errorMsg['title']}}
    </div>
    <div class="form-group">
        <label for="updateTitle" class="col-sm-2 control-label" name='title'>Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value = "<?php echo $post->title; ?>">
        </div>
    </div>


    <div class="alert fade in alert-danger" ng-if="errorMsg['content']">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{errorMsg['content']}}
    </div>
    <div class="form-group">
        <label for="updateContent" class="col-sm-2 control-label">Content</label>
        <div class="col-sm-10">
            <textarea style="height: 250px;" class="form-control" row="3" name='content'><?php echo $post->content; ?></textarea>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" ng-click="setMsg()" name="submit">Update</button>
        </div>
    </div>
</form>
<?php $content=ob_get_clean() ?>
<?php require 'layout.php' ?>
