<?php

include_once 'includes/imagethread_class.php';
$oImageThread = new imagethread();
$aPosts = $oImageThread->getPosts();
$iNumberPosts = count($aPosts);
$aRecentPost = $aPosts[max(array_keys($aPosts))];
unset($aPosts[max(array_keys($aPosts))]);
krsort($aPosts);

$aHTML = [];
if (!empty($aRecentPost)) {
    $aHTML['recent'] = '<div id="title-recent-post" class="col-xs-12 col-md-12">' . $aRecentPost['title'] . '</div><div id="image-recent-post" class="col-xs-12 col-md-12"><img src="/insided/data/posts/' . $aRecentPost['file'] . '"/></div>';
}
if (!empty($aPosts)) {
    foreach ($aPosts as $aPost) {
        $aHTML['posts'] .= '<div class="post-list-item col-xs-12 col-md-12"><div class="post-list col-xs-12 col-md-12">' . $aPost['title'] . '</div><div class="post-list col-xs-12 col-md-12"><img src="/insided/data/posts/' . $aPost['file'] . '"/></div></div>';
    }
}

header("Content-type: application/json; charset=utf-8");

echo json_encode($aHTML);

