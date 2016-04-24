<?php

include_once 'includes/imagethread_class.php';
$oImageThread = new imagethread();
$iNumberViews = $oImageThread->countViews();
$aPosts = $oImageThread->getPosts();
$iNumberPosts = count($aPosts);

$sResponse = ['posts' => $iNumberPosts, 'views' => $iNumberViews];
header("Content-type: application/json; charset=utf-8");

echo json_encode($sResponse);
