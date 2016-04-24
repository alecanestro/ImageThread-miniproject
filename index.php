<?php
include_once 'includes/imagethread_class.php';
$oImageThread = new imagethread();
$iNumberViews = $oImageThread->countViews();
$aPosts = $oImageThread->getPosts();
$iNumberPosts = count($aPosts);
$aRecentPost = $aPosts[max(array_keys($aPosts))];
unset($aPosts[max(array_keys($aPosts))]);
krsort($aPosts);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/imagethread.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/imagethread.js"></script>
    </head>
    <body>
        <div id="top-bar" class="col-xs-12 col-md-12">
            <div id="top-bar-post" class="top-bar left col-xs-12 col-md-4">
                Posts: <span><?= $iNumberPosts; ?></span>
            </div>
            <div class="top-bar left col-xs-12 col-md-4">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-secondary" onclick="exportCSV()">Export button</button>
                </div>
            </div>
            <div id="top-bar-views" class="top-bar left col-xs-12 col-md-4">
                Views: <span><?= $iNumberViews; ?></span>
            </div>
        </div>
        <div id="reply-box" class="col-xs-12 col-md-12">
            <form id="imageFileForm" method="post" enctype="multipart/form-data" action="/insided/saveImage.php">
                <fieldset class="form-group">
                    <input type="text" class="form-control" id="imageTitle" name="imageTitle" placeholder="Image Title">
                </fieldset>
                <fieldset class="form-group">
                    <input type="file" class="form-control-file" id="imageFile" name="imageFile" onchange="sendImage();">
                    <small class="text-muted">Support JPEG, PNG and GIF image format. Image size upto 20 MB</small>
                </fieldset>
            </form>
        </div>

        <div id="image-post-box" class="col-xs-12 col-md-12">
            <div id="image-post-box-loading" class="col-xs-12 col-md-12"><img src="/insided/img/loading.gif" /></div>
            <div id="image-post-box-content" class="col-xs-12 col-md-12">
                <?php
                if (!empty($aRecentPost)) {
                    ?>
                    <div id="title-recent-post" class="col-xs-12 col-md-12"><?= $aRecentPost['title'] ?></div>
                    <div id="image-recent-post" class="col-xs-12 col-md-12"><img src="/insided/data/posts/<?= $aRecentPost['file'] ?>"/></div>        
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="posts-box" class="col-xs-12 col-md-12">
            <?php
            if (!empty($aPosts)) {
                foreach ($aPosts as $aPost) {
                    ?>
                    <div class="post-list-item col-xs-12 col-md-12">
                        <div class="post-list col-xs-12 col-md-12"><?= $aPost['title'] ?></div>
                        <div class="post-list col-xs-12 col-md-12"><img src="/insided/data/posts/<?= $aPost['file'] ?>"/></div>  
                    </div>  
                    <?php
                }
            }
            ?>

        </div>
    </body>
</html>
